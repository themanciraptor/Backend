#!/bin/bash
echo "#!/bin/bash
mysqldump --skip-extended-insert SASMA > /home/riley/G3/Backend/SASMA.sql
mysqldump --skip-extended-insert SASMA_test > /home/riley/G3/Backend/SASMA_test.sql
cd /home/riley/G3/Backend
git add SASMA.sql
git add SASMA_test.sql
" > ./.git/hooks/pre-commit

echo "#!/bin/bash

mysql SASMA < [path to Backend repo]/SASMA.sql
mysql SASMA_test < [path to Backend repo]/SASMA_test.sql
mysql SASMA_test < [path to Backend repo]/SASMA.sql" > ./.git/hooks/post-merge

echo "[mysqldump]
user=\"git\"
password=\"gitcommitpassward\"" > ~/.my.cnf

chmod +x .git/hooks/pre-commit
chmod +x .git/hooks/post-merge
chmod 600 ~/.my.cnf
