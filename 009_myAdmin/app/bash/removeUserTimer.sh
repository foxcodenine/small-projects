#!/bin/bash

# ______________________________________________________________________
# --- get cmd variables

export user=$1
export password=$2
export schema=$3
export userId=$4
export passHash=$5
export waitInactiveUserRemove=$6
export waitDemoUserRemove=$7

# ______________________________________________________________________
# --- wait for $6 sec before check if account is activated
sleep $waitInactiveUserRemove;

# ______________________________________________________________________
# --- get execut mysql

mysql   --user=${user} --password=${password}\
 -e "use ${schema};" -e "DELETE FROM User WHERE id=${userId} AND passHash=${passHash} AND accountState='Nonactivated';" 



# ______________________________________________________________________
# --- wait for $7 sec before check if account is demo

sleep $waitDemoUserRemove;
mysql   --user=${user} --password=${password}\
 -e "use ${schema};" -e "DELETE FROM User WHERE id=${userId} AND passHash=${passHash} AND roleGroup='Demo';" 

# ______________________________________________________________________

exit 0;