<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
</head>
<body style="margin:0;padding:0;background:#0A0C10;font-family:Arial,sans-serif;">
    <div style="max-width:560px;margin:0 auto;padding:40px 20px;">
        <div style="background:#13161C;border:1px solid #22262E;border-radius:6px;padding:32px;">
            <p style="color:#B08949;font-size:13px;text-transform:uppercase;letter-spacing:0.05em;margin:0 0 8px;">
                Nouveau message
            </p>
            <h1 style="color:#ECEDEE;font-size:20px;margin:0 0 24px;">
                {{ $contact->sujet ?? 'Sans objet' }}
            </h1>

            <p style="color:#92979F;font-size:14px;margin:0 0 4px;">De</p>
            <p style="color:#ECEDEE;font-size:15px;margin:0 0 20px;">
                {{ $contact->nom_expediteur }}
                @if($contact->email_expediteur)
                    &lt;{{ $contact->email_expediteur }}&gt;
                @endif
            </p>

            <div style="border-top:1px solid #22262E;padding-top:20px;">
                <p style="color:#c7cad0;font-size:14px;line-height:1.6;white-space:pre-line;margin:0;">
                    {{ $contact->message }}
                </p>
            </div>

            <div style="margin-top:32px;">
                <a href="{{ url('/contacts/' . $contact->id_contact) }}" style="display:inline-block;background:#B08949;color:#0A0C10;text-decoration:none;font-weight:bold;font-size:14px;padding:12px 24px;border-radius:2px;">
                    Voir dans l'admin
                </a>
            </div>
        </div>

        <p style="color:#5c6068;font-size:12px;text-align:center;margin-top:20px;">
            Envoyé automatiquement depuis le formulaire de contact de votre portfolio.
        </p>
    </div>
</body>
</html>