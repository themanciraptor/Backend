#!/bin/bash
echo "#!/bin/bash
mysqldump --skip-extended-insert SASMA > ~/Documents/Backend/SASMA.sql
cd ~/Documents/Backend
git add SASMA.sql" > ./.git/hooks/pre-commit

echo "#!/bin/bash
mysql SASMA < ../../SASMA.sql" > ./.git/hooks/post-merge

echo "[mysqldump]
user=\"git\"
password=\"gitcommitpassward\"" > ~/.my.cnf

chmod +x .git/hooks/pre-commit
chmod +x .git/hooks/post-merge
chmod 600 ~/.my.cnf