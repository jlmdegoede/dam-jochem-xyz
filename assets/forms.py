# forms.py
from django import forms
from .models import Asset

class AssetForm(forms.ModelForm):
    class Meta:
        model = Asset
        fields = ['title', 'description', 'asset', 'alt_text']