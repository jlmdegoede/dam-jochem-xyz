from django.db import models


class Asset(models.Model):
    title = models.CharField(max_length=255)
    description = models.TextField(blank=True, null=True)

    asset = models.FileField(upload_to='media/')

    alt_text = models.CharField(max_length=512)
    width = models.IntegerField(null=True)
    height = models.IntegerField(null=True)

