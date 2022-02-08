#!/bin/bash

# ______________________________________________________________________
# --- get cmd variables

export user=$1
export password=$2
export schema=$3
export userId=$4
export passHash=$5

# --- wait for $6 sec before start
sleep $6;

# ______________________________________________________________________
# --- get execut mysql

mysql   --user=${user} --password=${password}\
 -e "use ${schema};" -e "DELETE FROM User WHERE id=${userId} AND passHash=${passHash} AND accountState='Nonactivated';" 
exit 0;


# ______________________________________________________________________

