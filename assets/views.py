from django.contrib.auth.decorators import login_required

from assets.ai import describe_image
from assets.forms import AssetForm
from assets.models import Asset
from django.shortcuts import render, redirect, get_object_or_404

from PIL import Image

# Create your views here.

@login_required
def index(request):
    assets = Asset.objects.all()
    return render(request, 'index.html', {'assets': assets})


@login_required
def view(request, asset_id):
    asset = get_object_or_404(Asset, pk=asset_id)
    return render(request, 'asset/view.html', {'asset': asset})


@login_required
def generate_ai_attributes(request, asset_id):
    if request.method == "POST":
        asset = get_object_or_404(Asset, pk=asset_id)
        describe_image(asset)
        return redirect('assets_view', asset_id=asset.pk)


@login_required
def delete(request, asset_id):
    if request.method == "DELETE":
        asset = Asset.objects.get(pk=asset_id)
        asset.delete()
        return redirect('assets_list')


@login_required
def create(request):

    if request.method == "POST":
        form = AssetForm(request.POST, request.FILES)
        if form.is_valid():
            asset_file = form.cleaned_data.get('asset')
            image = Image.open(asset_file)
            width, height = image.size

            result = form.save(commit=False)
            result.width = width
            result.height = height

            return redirect('assets_list')
    else:
        form = AssetForm()
    return render(request, 'asset/create.html', {'form': form})