# /// script
# requires-python = ">=3.10"
# dependencies = [
#     "dotenv",
#     "requests",
# ]
# ///

import os
import requests
from dotenv import load_dotenv

dotenv_path = "/home/agroprot/public_html/.env"
load_dotenv(dotenv_path)

FACEBOOK_APP_ID = os.getenv("FACEBOOK_APP_ID")
FACEBOOK_APP_SECRET = os.getenv("FACEBOOK_APP_SECRET")
FACEBOOK_ACCESS_TOKEN = os.getenv("FACEBOOK_ACCESS_TOKEN")

def refresh_long_lived_token():
    """Refresh the long-lived user access token before it expires."""
    url = "https://graph.facebook.com/v22.0/oauth/access_token"
    params = {
        "grant_type": "fb_exchange_token",
        "client_id": FACEBOOK_APP_ID,
        "client_secret": FACEBOOK_APP_SECRET,
        "fb_exchange_token": FACEBOOK_ACCESS_TOKEN,
    }

    response = requests.get(url, params=params)
    data = response.json()

    if "access_token" in data:
        new_token = data["access_token"]
        update_env_file(dotenv_path, "FACEBOOK_ACCESS_TOKEN", new_token)

def update_env_file(env_path, key, value):
    """Update a specific key in the .env file."""
    lines = []
    
    with open(env_path, "r") as file:
        lines = file.readlines()
    
    with open(env_path, "w") as file:
        for line in lines:
            if line.startswith(f"{key}="):
                file.write(f"{key}={value}\n")
            else:
                file.write(line)

if __name__ == "__main__":
    refresh_long_lived_token()

