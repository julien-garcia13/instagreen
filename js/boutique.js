// Système de paiement Stripe
window.onload = () =>
{
    // les variables
    let stripe = Stripe('pk_test_51KUAgRJcdqGu57WBxNMKP4B4bOIAsMdZx4iQiNzPCF53TxMDBFjqApaqTEIPbkaUy0ZpIjTJlP7W8UXeP1yZrooH00S4xt7g0s') // Clé publique
    let elements = stripe.elements()
    let redirect = "../paiement-success.php"
    // Objets de la page
    let cardHolderName = document.getElementById("cardholder-name")
    let cardButton = document.getElementById("card-button")
    let clientSecret = cardButton.dataset.secret;
    // Formulaire CB
    let card = elements.create("card")
    card.mount("#card-elements")
    // Gestion de la saisie
    card.addEventListener("change", (event) =>
    {
        let displayError = document.getElementById("card-errors")
        if(event.error)
        {
            displayError.textContent = event.error.message;
        }
        else
        {
            displayError.textContent = "";
        }
    }
    )
    // Gestion de paiement
    cardButton.addEventListener("click", () =>
    {
        stripe.handleCardPayment(clientSecret, card, {payment_method_data: {billing_details: {name: cardHolderName.value}}})
        .then((result) =>
        {
            if(result.error)
            {
                document.getElementById("errors").innerText = result.error.message
            }
            else
            {
                document.location.href = redirect
            }
        }
        )
    }
    )
}
// Recherche par autocomplétion
function recupererTexte(event)
{
	var string = event.textContent;
	fetch("php/traitement/trecherche.php",
	{
        method:"POST",body: JSON.stringify
        (
            {
                search_name : string
            }
        ),
		headers :
        {
            "Content-type" : "application/json; charset=UTF-8"
        }
	}
	)
	.then(function(reponse)
    {
		document.getElementsByName('search_box')[0].value = string;
		document.getElementById('resultat-de-recherche').innerHTML = '';
	}
	)
}
function chargementDonnees(name)
{
	if(name.length > 2)
	{
		var via_donnees = new FormData();
		via_donnees.append('name', name);
		var requete_ajax = new XMLHttpRequest();
		requete_ajax.open('POST', 'php/traitement/trecherche.php');
		requete_ajax.send(via_donnees);
		requete_ajax.onreadystatechange = function()
		{
			if(requete_ajax.readyState == 4 && requete_ajax.status == 200)
			{
				var reponse = JSON.parse(requete_ajax.responseText);
				var html = '<div class="liste-de-recherche">';
				if(reponse.length > 0)
				{
					for(var count = 0; count < reponse.length; count++)
					{
						html += '<a href="php/fiche-produit.php?id='+reponse[count].id+'" class="resultat" onclick="recupererTexte(this)">'+reponse[count].name+'</a><br />';
					}
				}
				else // Si aucun produit n'est trouvé dans la recherche
				{
					html += '<p6 class="message-aucun-produit">Aucun produit trouvé.</p6>';
				}
				html += '</div>';
				document.getElementById('resultat-de-recherche').innerHTML = html;
			}
		}
	}
	else
	{
		document.getElementById('resultat-de-recherche').innerHTML = '';
	}
}