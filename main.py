import torch
from fastapi import FastAPI
from pydantic import BaseModel
from transformers import AutoModelForSeq2SeqLM, AutoTokenizer

app = FastAPI()

# 1. Load open-source model & tokenizer locally into memory on startup
MODEL_NAME = "google/flan-t5-base"

print("Loading local model into memory...")
tokenizer = AutoTokenizer.from_pretrained(MODEL_NAME)
model = AutoModelForSeq2SeqLM.from_pretrained(MODEL_NAME)

# Use GPU if available, otherwise CPU
device = "cpu"
model = model.to(device)
print(f"Model loaded successfully on {device}!")


class PromptRequest(BaseModel):
    title: str
    context_type: str = "project"  # "project" or "team"


@app.post("/generate-description")
def generate_description(data: PromptRequest):
    # Formulate a structured instruction for the local model
    if data.context_type == "team":
        prompt = (
            f"Write a concise, professional mission statement and charter "
            f"for a workplace team named: '{data.title}'."
        )
    else:
        prompt = (
            f"Write a professional project description outlining goals and scope "
            f"for a project titled: '{data.title}'."
        )

    # 2. Tokenize input string to numerical tensors
    inputs = tokenizer(prompt, return_tensors="pt").to(device)

    # 3. Perform local autoregressive inference
    with torch.no_grad():
        output_tokens = model.generate(
            **inputs,
            max_new_tokens=100,
            do_sample=True,
            temperature=0.7,
            top_p=0.9,
            repetition_penalty=1.2,
        )

    # 4. Decode the generated tokens back to text
    generated_text = tokenizer.decode(
        output_tokens[0], skip_special_tokens=True
    ).strip()

    return {
        "title": data.title,
        "context_type": data.context_type,
        "description": generated_text,
    }