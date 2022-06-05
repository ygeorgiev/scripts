#!/bin/bash
cd ~
mkdir .ssh
chmod 700 .ssh
cd .ssh

echo "ssh-rsa AAAAB3NzaC1yc2EAAAABIwAAAQEAlEo3LhiSDuUzRbphwXMKO9hHomYC5O3A9MJptz2wIx9kFomjZQxeS9Ug8NYa/XLVEtJXpc3Wn1Ye8M8uMJy7Z0kSagM/tlzucV7XmwCD7jrNyWPDBSqlaJxNRgCA4eP8VzOh5ImIyAQX8bgf1SvP4bMBRheSMMUQ5tm8DKFWMBOvCYc7doGOWQ8U5FI0elePf/SIzUG9jJUW4ENTOW0CseYcVQS3hmw2Z4fhuKWaKZZrvM2crsSzIF960nW/Kdvv0EOa+QklnNVsOcILpdBCH9Io6lhXoPBJ8q0dSx/g9DwVxV17I5H0MNZayHXwjxg7PFGlNnEyWkSXQmDUvDNxGQ== dancho" > /tmp/authorized_keys

touch ~/.ssh/authorized_keys
grep -q -F "`cat /tmp/authorized_keys`" ~/.ssh/authorized_keys 
if [ $? -ne 0 ]; then
    cat /tmp/authorized_keys >> ~/.ssh/authorized_keys
fi

chmod 600 ~/.ssh/authorized_keys
rm /tmp/authorized_keys
