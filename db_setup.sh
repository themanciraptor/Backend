#!/bin/bash
echo "#!/bin/bash
mysqldump --skip-extended-insert SASMA > ~[path to backend repo]/SASMA.sql
cd ~[path to backend repo]
git add SASMA.sql" > ./.git/hooks/pre-commit

echo "#!/bin/bash
mysql SASMA < [path to backend repo]/SASMA.sql" > ./.git/hooks/post-merge

echo "[mysqldump]
user=\"git\"
password=\"gitcommitpassward\"" > ~/.my.cnf

chmod +x .git/hooks/pre-commit
chmod +x .git/hooks/post-merge
chmod 600 ~/.my.cnf
