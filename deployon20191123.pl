#!/bin/bash
echo "Content-type: text/plain\n";
echo '';
cd /var/www/domains/st.nailclick.qzo.su/ || exit > /dev/null
git reset --hard > /dev/null
git pull https://github.com/Fajoo/NailClick  > /dev/null