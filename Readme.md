# OrderAdditionalInformation
A Thelia module which allows your customers to add one or more comments to their orders

# Exemple dans page order-invoice

```
<div class="panel">
    <div class="panel-heading">{intl l="En cas d'indisponibilité"}</div>
    <div class="panel-body">
        <div class="radio">
            <p>{intl l="Si une des plantes commandées n'est pas disponible lors de la préparation de votre commande, que souhaitez vous faire ?"}</p>

            <div class="radio">
                <label>
                    <input type="radio" name="comment[remplacement]" value="Échanger les plantes en rupture de stock contre des plantes équivalentes" checked>
                    Échanger les plantes en rupture de stock contre des plantes équivalentes
                </label>
            </div>

            <div class="radio">
                <label>
                    <input type="radio" name="comment[remplacement]" value="Recevoir en remboursement un chèque en même temps que votre colis" checked>
                    Recevoir en remboursement un chèque en même temps que votre colis
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="comment[remplacement]" value="Créditer mon compte fidélité d’une valeur équivalente en bons d’achat" checked>
                    Créditer mon compte fidélité d’une valeur équivalente en bons d’achat à utiliser
                    sans limitation dans le temps lors de votre prochaine commande.
                </label>
            </div>
        </div>
    </div>
</div>

<div class="panel">
    <div class="panel-heading">{intl l="Joindre un message à votre commande"}</div>
    <div class="panel-body">
        <p>{intl l="Merci de nous indiquer ici toute information utile au sujet de votre commande ou de sa livraison"}</p>
        <textarea name="comment[message]" class="form-control"></textarea>
    </div>
</div>
```