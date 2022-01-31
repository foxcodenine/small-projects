#!/bin/bash
sleep 2;

#export schema=$1
#export userId=$2
#export passHash=$3

export schema=$1
export email=$2
export passHash=$3


mysql   --user=sparrow --password=umbrella\
 -e "set @email='${email}';" -e "use ${schema};" -e "source dbscript.sql;"

exit 0;

#-e "set @userId='${userId}'; set @passHash='${passHash}';"
#-e "set @email='${email}'; set @passHash='${passHash}';"


#  ./my.sh  project_009_myAdmin james@gmail.com &


