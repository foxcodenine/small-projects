#!/bin/bash

# # ______________________________________________________________________
# # --- get cmd variables

export user=$1
export password=$2
export schema=$3
export userId=$4
export passHash=$5

export time1=$6
export time2=$7
export key=$6
export secret=$7
export region=$8
export bucket=$9



# # ______________________________________________________________________
# # --- wait for $6 sec before check if account is activated
# sleep $6;

# # ______________________________________________________________________
# # --- get execut mysql

# mysql   --user=${user} --password=${password}\
#  -e "use ${schema};" -e "DELETE FROM User WHERE id=${userId} AND passHash=${passHash} AND accountState='Nonactivated';" 

# # ______________________________________________________________________
# # --- wait for $7 sec before check if account is demo
# sleep $7;

# # ______________________________________________________________________
# # --- get execut mysql

# mysql   --user=${user} --password=${password}\
#  -e "use ${schema};" -e "DELETE FROM User WHERE id=${userId} AND passHash=${passHash} AND roleGroup='Demo';" 

# # ______________________________________________________________________




myvariable=$(echo "SELECT count(id) FROM User WHERE id = 63" | mysql ${schema} --user=${user} --password=${password});

# echo $myvariable; 

user_in_db=$(echo $myvariable | cut -d ' ' -f 2)

if  [ $user_in_db == 1 ]
then
    echo 'User not deleted';
else
    php ./timer_remove_aws_img.php $key  $secret $region $bucket $userId
fi


exit 0;

