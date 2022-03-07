#!/bin/bash

# ______________________________________________________________________
# --- get cmd variables

export user=$1
export password=$2
export schema=$3
export userId=$4
export passHash=$5

export time1=${6}
export time2=${7}

export key=${8}
export secret=${9}
export region=${10}
export bucket=${11}


# ______________________________________________________________________
# --- wait for $6 sec before check if account is activated
sleep $6;

# ______________________________________________________________________
# --- get execut mysql

mysql   --user=${user} --password=${password}\
 -e "use ${schema};" -e "DELETE FROM User WHERE id=${userId} AND passHash=${passHash} AND accountState='Nonactivated';" 

# ______________________________________________________________________
# --- wait for $7 sec before check if account is demo
sleep $7;

# ______________________________________________________________________
# --- get execut mysql

mysql   --user=${user} --password=${password}\
 -e "use ${schema};" -e "DELETE FROM User WHERE id=${userId} AND passHash=${passHash} AND roleGroup='Demo';" 

# ______________________________________________________________________
# ______________________________________________________________________


myvariable=$(echo "SELECT count(id) FROM User WHERE id = ${userId}" | mysql ${schema} --user=${user} --password=${password});


user_in_db=$(echo $myvariable | cut -d ' ' -f 2)

if  [ $user_in_db == 1 ]
then
    echo 'User in db' ;
else
    echo 'User NOT in db' ;
    echo "$key  $secret $region $bucket $userId" 
    php ./app/bash/timer_remove_aws_img.php $key  $secret $region $bucket "${userId}" 
fi


exit 0;

