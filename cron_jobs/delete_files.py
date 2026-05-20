import os
import time

directories = [
    "/home/agroprot/public_html/public/img/linkedin-media",
]

MAX_AGE_DAYS = 7

def delete_old_files(directory_path, max_age_days):
    """Delete files older than max_age_days from the specified directory."""
    if not os.path.exists(directory_path):
        return 0, 0

    # Calculate the cutoff time (current time - max age)
    cutoff_time = time.time() - (max_age_days * 24 * 60 * 60)
    deleted_count = 0
    error_count = 0
    
    # Walk through the directory
    for root, _, files in os.walk(directory_path):
        for file in files:
            file_path = os.path.join(root, file)
            
            try:
                # Get the file's last modification time
                file_mtime = os.path.getmtime(file_path)
                
                # If the file is older than the cutoff time, delete it
                if file_mtime < cutoff_time:
                    os.remove(file_path)
                    deleted_count += 1
            except Exception as e:
                error_count += 1
    
    return deleted_count, error_count

def main():
    """Main function to delete old files from all configured directories."""
    for directory in directories:
        delete_old_files(directory, MAX_AGE_DAYS)

if __name__ == "__main__":
    main()
