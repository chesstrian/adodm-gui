#!/bin/bash
##
# Falta verificar que se ingrese $1 o más, de lo contrario no permitir que se ejecute.

echo "Creando Proyecto $1"

cd /var/www/svn/
svnadmin create $1
svn mkdir file:///var/www/svn/$1/trunk file:///var/www/svn/$1/tags file:///var/www/svn/$1/branches -m "$1 Initial SVN Structure"
chown -R apache\: $1

exit 0
