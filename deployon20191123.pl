#!/bin/bash
echo "Content-type: text/plain\n";
echo '';
cd /var/www/domains/g2-public.qzo.su/ || exit > /dev/null
git reset --hard > /dev/null
git pull ssh://gafurovstudio@bitbucket.org/gafurovstudio/g2-public.git develop > /dev/null
#git@bitbucket.org:gafurovstudio/g2.git
