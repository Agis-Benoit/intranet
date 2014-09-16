function creeXHR() //fonction qui va cr�e une instance pour les requete XML
{
    var request = false;
if (window.XMLHttpRequest) //v�rifie les diff�rent navigateur
		{
            request = new XMLHttpRequest();//pour FireFox,Op�ra
            if (request.overrideMimeType) {
                request.overrideMimeType('text/xml');
            }
        }
       else if (window.ActiveXObject) 
		{
  			try 
 				 { // essaie de charger l'objet pour IE
   					 request = new ActiveXObject("Msxml2.XMLHTTP");
				  } 
		   catch (e) 
  				{
   				  try 
   					  { // essaie de charger l'objet pour une autre version IE
    					    request = new ActiveXObject("Microsoft.XMLHTTP");
					  } 
    			 catch (e) 
    					 {
     					   window.alert("Veuillez mettre a jour votre navigateur pour la navigation sur ce site");
							window.close;
 					    }
 			 } 
        }
if (!request) {//si la cr�ation de l'instance echoue une fen�tre vous annoncera qu'il ne pourra executer le script 
            alert('Abandon,impossible de cr�er une instance XMLHTTP');
            return false;
        }
    return request;
}

function onglet(ID)//fonction qui va g�rer le contenu dans le div en r�cuperant les donn�es 
	{
		var xhr=creeXHR();//cr�ation de l'instance
		var url="./requete.php?page="+ID;//ID va servir a la page requete pour chercher le contenu apartenant a l'ID
		xhr.open( "GET",url, true);//ouverture du fichier 
		xhr.onreadystatechange=function(){
		 if(xhr.readyState  == 4)//une fois les donn�es charger
        			 {
               				 
							 if (xhr.status == 200)//qu'il n'y a pas d'erreur
							 {
               				 	var doc2=xhr.responseText;
							 	document.getElementById("contenu").innerHTML=doc2;//envoi les donner dans le div avec l'ID 'contenu'								
							 }
							 
							 for (i=0 ;i<compteur ;i++)//la variable compteur qui a �t� initialiser au debut de la page onglet.php qui indique le nombre d'onglet
							 {
							 		if (tabu[i]==ID)//change la classe de l'onglet actif
									{
							 			document.getElementById(tabu[i]).className="active";
									}
									if (tabu[i]!=ID)//change la classe de l'onglet en innactif
									{
							 			document.getElementById(tabu[i]).className="eteint";
							 		}
							 }
   					 }
					 };
		xhr.send("");//envoi des donn�e au script requete.php (ici NULL) 
	}