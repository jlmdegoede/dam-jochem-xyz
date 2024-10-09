import os
import uuid
from datetime import datetime

from django.db import models


def get_upload_path(instance, filename):
    # Get the current date for YYYY/MM structure
    today = datetime.now()
    path = today.strftime('%Y/%m')

    # Extract the file extension
    ext = filename.split('.')[-1]

    # Generate a random string and append it to the file name
    random_string = uuid.uuid4().hex[:8]  # 8 characters of random string
    new_filename = f"{os.path.splitext(filename)[0]}_{random_string}.{ext}"

    # Return the full path where the file will be stored
    return os.path.join('media/', path, new_filename)


class Asset(models.Model):
    title = models.CharField(max_length=255)
    description = models.TextField(blank=True, null=True)

    asset = models.FileField(upload_to=get_upload_path)

    alt_text = models.CharField(max_length=512)
    width = models.IntegerField(null=True)
    height = models.IntegerField(null=True)

