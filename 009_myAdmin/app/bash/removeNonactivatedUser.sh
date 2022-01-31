#!/bin/bash

# ______________________________________________________________________

export user=$1
export password=$2
export schema=$3
export userId=$4
export passHash=$5

sleep 30;

# ______________________________________________________________________


mysql   --user=${user} --password=${password}\
 -e "use ${schema};" -e "DELETE FROM User WHERE id=${userId} AND passHash=${passHash} AND accountState='Nonactivated';" 
exit 0;


# ______________________________________________________________________

