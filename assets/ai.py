import json

import ollama

def describe_image(asset):
    response = ollama.chat(model='llava', messages=[
        {
            'role': 'user',
            'content': f"1) Title: Generate a title of 10 words or less for this image"
                       f"2) Alt: Describe the following image in 1 sentence of max 20 words for the alt attribute on a HTML img tag"
                       f"3) Description: Describe the following image in max 30 words"
                       "Provide the output in valid JSON like so {\"title\": \"\", \"alt\":\"\", \"description\":\"\"}",
            'images': [asset.asset.file.name]
        },
    ])
    json_response = json.loads(response['message']['content'].replace('```', '').replace('json', ''))

    asset.title = json_response['title']
    asset.alt_text = json_response['alt']
    asset.description = json_response['description']
    asset.save()