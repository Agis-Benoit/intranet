#!/bin/bash
#
#
# Author: franckwastaken - 07/07/2016
# MAJ franckwastaken - 11/07/2016
# MAJ franckwastaken - 21/07/2016
# VARIABLES (garder l'ordre du script d'appel !
# ---------------------------------------------
DB_NAME_TO_CREATE="intranet_v3_0_dev"
MYSQL_SERVER_NAME_DEST="dev-intranet.agis.fr"
MYSQL_USER_NAME_DEST="root"
MYSQL_USER_PASSWORD_DEST="8ale!ne"
DIR_EAI="/u1/DATA01/eai/intranet-dev/import/data/"
DIR_EAI_OK="/u1/DATA01/eai/intranet-dev/import/ok/"
DIR="$1"

$DIRapps/fta2Arcadia/import_Arcadia2Fta_data.sh $DB_NAME_TO_CREATE $MYSQL_SERVER_NAME_DEST $MYSQL_USER_NAME_DEST $MYSQL_USER_PASSWORD_DEST $DIR_EAI $DIR_EAI_OK $DIR



