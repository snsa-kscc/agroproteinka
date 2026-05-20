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

LINKEDIN_CLIENT_ID = os.getenv("LINKEDIN_CLIENT_ID")
LINKEDIN_CLIENT_SECRET = os.getenv("LINKEDIN_CLIENT_SECRET")
LINKEDIN_REFRESH_TOKEN = os.getenv("LINKEDIN_REFRESH_TOKEN")
LINKEDIN_ACCESS_TOKEN = os.getenv("LINKEDIN_ACCESS_TOKEN")

def refresh_linkedin_token():
    """Refresh the LinkedIn access token using the refresh token."""
    url = "https://www.linkedin.com/oauth/v2/accessToken"
    
    # Prepare the request data
    data = {
        "grant_type": "refresh_token",
        "refresh_token": LINKEDIN_REFRESH_TOKEN,
        "client_id": LINKEDIN_CLIENT_ID,
        "client_secret": LINKEDIN_CLIENT_SECRET
    }
    
    # Make the POST request with form-encoded data
    headers = {"Content-Type": "application/x-www-form-urlencoded"}
    response = requests.post(url, data=data, headers=headers)
    
    # Process the response
    if response.status_code == 200:
        result = response.json()
        
        # Extract the new tokens
        new_access_token = result.get("access_token")
        
        # Update the tokens in the .env file
        if new_access_token:
            update_env_file(dotenv_path, "LINKEDIN_ACCESS_TOKEN", new_access_token)
        return result
    else:
        print(f"Error refreshing LinkedIn token: {response.status_code}")
        print(response.text)
        return None

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
    refresh_linkedin_token()

