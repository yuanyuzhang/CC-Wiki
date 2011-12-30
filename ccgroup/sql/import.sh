#! /bin/sh
function usage()
{
	echo "Usage: `basename $0` -d [dbname] -u [user] -p [password] -f [prefix in .sql] -F [prefix in db]" 
	exit 1
}
if [ $# = 0 ]; then
	usage
fi

while getopts d:u:p:f:F: OPTION
do
	case $OPTION in
	d) DB=$OPTARG
	;;
	u) USER=$OPTARG
	;;
	p) PASSWORD=$OPTARG
	;;
	f) PRE_SQL=$OPTARG
	;;
	F) PRE_DB=$OPTARG
	;;
	\?) usage
	;;
	esac
done
TABLE=('cc_class' 'cc_page' 'cc_interestor' 'cc_participator' 'cc_conf_gb' 'cc_conf_wb')
SQL='.sql'
for var in ${TABLE[@]};do
	mysql -u$USER -p$PASSWORD $DB < $var$SQL
	qry='alter table '$DB'.'$PRE_SQL$var' rename to '$DB'.'$PRE_DB$var
	echo $qry
	echo $qry > tmp.sql
	mysql -u$USER -p$PASSWORD < tmp.sql 
	rm tmp.sql
done
echo 'Finish!'

