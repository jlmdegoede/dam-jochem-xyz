import ollama

def describe_image(asset):
    response = ollama.chat(model='llava', messages=[
        {
            'role': 'user',
            'content': f"Generate a title of 10 words or less for this image",
            'images': [asset.asset.file.name]
        },
    ])
    title = response['message']['content']

    response2 = ollama.chat(model='llava', messages=[
        {
            'role': 'user',
            'content': f"Describe the following image in 1 sentence of max 30 words for the alt attribute on a HTML img tag",
            'images': [asset.asset.file.name]
        },
    ])
    alt_text = response2['message']['content']

    response3 = ollama.chat(model='llava', messages=[
        {
            'role': 'user',
            'content': f"Describe the following image in max 100 words",
            'images': [asset.asset.file.name]
        },
    ])
    description = response3['message']['content']

    asset.title = title
    asset.alt_text = alt_text
    asset.description = description
    asset.save()