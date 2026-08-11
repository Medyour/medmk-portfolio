<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Nouvelle demande de contact</title>
</head>
<body>
    <h1>Nouvelle demande de contact</h1>
    <p><strong>Nom :</strong> {{ $contact['name'] }}</p>
    <p><strong>E-mail :</strong> {{ $contact['email'] }}</p>
    <p><strong>Organisation :</strong> {{ $contact['organization'] ?: 'Non renseignée' }}</p>
    <p><strong>Catégorie :</strong> {{ config('contact.categories.'.$contact['category']) }}</p>
    <p><strong>Message :</strong></p>
    <p>{!! nl2br(e($contact['message'])) !!}</p>
</body>
</html>
