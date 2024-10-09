from django.contrib.auth.models import User
from django.db import models

# Create your models here.

class Account(models.Model):

    PLANS = [('1', 'Gratis'), ('2', 'Premium')]

    user = models.OneToOneField(User, on_delete=models.CASCADE)
    subscription_plan = models.CharField(max_length=25, choices=PLANS)