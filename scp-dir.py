import os
import argparse
import paramiko
from scp import SCPClient

def create_ssh_client(hostname, username, password):
    ssh = paramiko.SSHClient()
    ssh.set_missing_host_key_policy(paramiko.AutoAddPolicy())
    ssh.connect(hostname, username=username, password=password)
    return ssh

def download_directory_via_scp(ssh, remote_dir_path, local_dir_path):
    with SCPClient(ssh.get_transport()) as scp:
        scp.get(remote_dir_path, local_dir_path, recursive=True)

def main():
    parser = argparse.ArgumentParser(description="Download directory from remote server using SCP.")
    parser.add_argument("-u", "--username", required=True, help="Username for SSH")
    parser.add_argument("-H", "--hostname", required=True, help="Hostname or IP address of the SSH server")
    parser.add_argument("-p", "--password", required=True, help="Password for SSH")
    parser.add_argument("-d", "--remote_path", required=True, help="Remote directory path to download")
    parser.add_argument("local_path", help="Local directory to save the files")

    args = parser.parse_args()

    ssh_client = create_ssh_client(args.hostname, args.username, args.password)
    try:
        local_dir_path = os.path.join(args.local_path, os.path.basename(args.remote_path))
        download_directory_via_scp(ssh_client, args.remote_path, local_dir_path)
        print(f"Directory downloaded successfully to {local_dir_path}")
    finally:
        ssh_client.close()

if __name__ == "__main__":
    main()
