#!/bin/sh
#Script permettant d'effectuer les copies Intersites
#Cr�� Par Boris 2004-03-03
#ATTENTION !! Ce script a �t� autog�n�r� via datasync.sh
#Ne le modifiez qu'� l'aide du fichier PHP de l'intranet Agis
/data/etc/init.d/ncpmanager.sh restart
echo -n 'D�marrage de copie des donn�es intersite �:'
date

rm -Rfv /mnt/ncp/knoppix/10.3.1.5/VOL1/data/partages/listing_ft_pyc_saveur/*
cp --reply=yes -vr /mnt/ncp/knoppix/10.1.1.5/VOL1/data/partages/listing_ft_pyc_saveur /mnt/ncp/knoppix/10.3.1.5/VOL1/data/partages/.backup/listing_ft_pyc_saveur.tmp
date
mv --reply=yes -v /mnt/ncp/knoppix/10.3.1.5/VOL1/data/partages/.backup/listing_ft_pyc_saveur.tmp/* /mnt/ncp/knoppix/10.3.1.5/VOL1/data/partages/listing_ft_pyc_saveur
date
rm -Rfv /mnt/ncp/knoppix/10.3.1.5/VOL1/data/partages/.backup/listing_ft_pyc_saveur.tmp
date

rm -Rfv /mnt/ncp/knoppix/10.2.1.5/VOL1/data/partages/listing_ft_pyc_saveur/*
cp --reply=yes -vr /mnt/ncp/knoppix/10.1.1.5/VOL1/data/partages/listing_ft_pyc_saveur /mnt/ncp/knoppix/10.2.1.5/VOL1/data/partages/.backup/listing_ft_pyc_saveur.tmp
date
mv --reply=yes -v /mnt/ncp/knoppix/10.2.1.5/VOL1/data/partages/.backup/listing_ft_pyc_saveur.tmp/* /mnt/ncp/knoppix/10.2.1.5/VOL1/data/partages/listing_ft_pyc_saveur
date
rm -Rfv /mnt/ncp/knoppix/10.2.1.5/VOL1/data/partages/.backup/listing_ft_pyc_saveur.tmp
date

echo -n 'Fin de copie des donn�es intersites �:'
date
/data/etc/init.d/ncpmanager.sh stop
