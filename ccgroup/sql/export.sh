#! /bin/sh
function usage()
{
	echo "Usage: `basename $0` -d [dbname] -u [user] -p [password] -F [prefix in db]" 
	exit 1
}
if [ $# = 0 ]; then
	usage
fi

while getopts d:u:p:F: OPTION
do
	case $OPTION in
	d) DB=$OPTARG
	;;
	u) USER=$OPTARG
	;;
	p) PASSWORD=$OPTARG
	;;
	F) PRE=$OPTARG
	;;
	\?) usage
	;;
	esac
done
TABLE=('cc_class' 'cc_page' 'cc_interestor' 'cc_participator' 'cc_conf_gb' 'cc_conf_wb')
SQL='.sql'
for var in ${TABLE[@]};do
	mysqldump -u$USER -p$PASSWORD $DB $PRE$var > $var$SQL
done
