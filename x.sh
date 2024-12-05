#!/bin/bash

# Provide the path to your PEM key file
PEM_KEY_PATH="$1"  # Accept the PEM key file path as the first argument
if [[ -z "$PEM_KEY_PATH" ]]; then
  echo "Error: Please provide the PEM key file path as the first argument."
  exit 1
fi

# Get all EC2 instance IDs
instance_ids=$(aws ec2 describe-instances --query "Reservations[].Instances[].InstanceId" --output text)

# Loop through each instance ID
for instance_id in $instance_ids; do
  # Get the public IP of the instance
  ip_address=$(aws ec2 describe-instances --instance-ids $instance_id --query "Reservations[].Instances[].PublicIpAddress" --output text)
  
  # Get the RDP password using the provided PEM key
  rdp_password=$(aws ec2 get-password-data --instance-id $instance_id --priv-launch-key "$PEM_KEY_PATH" --query "PasswordData" --output text)
  
  # Default Windows username for EC2
  username="Administrator"

  # Print the instance details
  echo "Instance ID: $instance_id"
  echo "IP Address: $ip_address"
  echo "Username: $username"
  echo "Password: $rdp_password"
  echo "------------------------------------------"
done
