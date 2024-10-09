from django.shortcuts import render, redirect
from django.contrib.auth.forms import UserCreationForm
from django.contrib.auth import login
from django.contrib import messages

from accounts.models import Account


def register(request):
    if request.method == 'POST':
        form = UserCreationForm(request.POST)
        if form.is_valid():
            user = form.save()

            account = Account()
            account.user = user
            account.subscription_plan = '1'
            account.usage_count = 0
            account.save()

            login(request, user)
            messages.success(request, 'Successfully registered')
            return redirect('asset_list')
    else:
        form = UserCreationForm()

    return render(request, 'accounts/register.html', {'form': form})