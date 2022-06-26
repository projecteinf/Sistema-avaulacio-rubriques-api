git add -A

if [ $# -lt 3 ]
then
	echo 'Format: ./git.sh "Comentari modificació" -b nombranca'
	echo 'Exemple: ./git.sh "Afegit component ..." -b main'
	exit 1
fi

if [[ $2 != "-b" ]]
then
	echo 'Format: ./git.sh "Comentari modificació" -b nombranca'
	echo 'Exemple: ./git.sh "Afegit component ..." -b main'
	exit 1
fi


git commit -m "$1"
git push origin "$3"

