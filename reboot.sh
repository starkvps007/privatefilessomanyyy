# Step 1: Get all instance IDs
INSTANCE_IDS=$(aws ec2 describe-instances \
    --filters "Name=instance-state-name,Values=running" \
    --query "Reservations[*].Instances[*].InstanceId" \
    --output text)

if [ -z "$INSTANCE_IDS" ]; then
    echo "No running instances found to reboot."
    exit 1
fi

# Step 2: Reboot all instances
aws ec2 reboot-instances --instance-ids $INSTANCE_IDS

echo "Reboot initiated for the following instances:"
echo "$INSTANCE_IDS"
