#!/bin/bash
echo "#!/bin/bash
mysqldump --skip-extended-insert SASMA > ~[Documents\uni\CS 372\Final Proj\Backend]/SASMA.sql
cd ~[Documents\uni\CS 372\Final Proj\Backend]
git add SASMA.sql" > ./.git/hooks/pre-commit

echo "#!/bin/bash
mysql SASMA < [path to Backend repo]/SASMA.sql" > ./.git/hooks/post-merge

echo "[mysqldump]
user=\"git\"
password=\"gitcommitpassward\"" > ~/.my.cnf

chmod +x .git/hooks/pre-commit
chmod +x .git/hooks/post-merge
chmod 600 ~/.my.cnf
