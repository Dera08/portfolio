<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Lecture du message
        </h2>
    </x-slot>

    <style>
        .kgv-admin{
            --bg: #0A0C10; --surface: #13161C; --border: #22262E;
            --text: #ECEDEE; --text-dim: #92979F; --accent: #B08949;
            background:var(--bg); color:var(--text);
            font-family:'Inter',sans-serif;
        }
        .kgv-admin h1{font-family:'Fraunces',serif;font-weight:500;}
        .kgv-back{
            display:inline-flex;align-items:center;gap:6px;font-size:0.85rem;color:var(--text-dim);
            margin-bottom:24px;
        }
        .kgv-back:hover{color:var(--accent);}
        .kgv-panel{background:var(--surface);border:1px solid var(--border);border-radius:4px;padding:32px;}
        .kgv-msg-header{
            display:flex;flex-direction:column;gap:12px;padding-bottom:24px;
            border-bottom:1px solid var(--border);margin-bottom:24px;
        }
        @media(min-width:768px){
            .kgv-msg-header{flex-direction:row;align-items:center;justify-content:space-between;}
        }
        .kgv-msg-header h1{font-size:1.3rem;}
        .kgv-msg-header p{color:var(--text-dim);font-size:0.88rem;margin-top:4px;}
        .kgv-msg-header a{color:var(--accent);}
        .kgv-date-badge{
            font-size:0.78rem;color:var(--text-dim);background:var(--bg);border:1px solid var(--border);
            padding:6px 12px;border-radius:2px;width:fit-content;white-space:nowrap;
        }
        .kgv-msg-body{color:#c7cad0;font-size:0.92rem;line-height:1.7;white-space:pre-line;padding:8px 0 28px;}
        .kgv-msg-actions{
            display:flex;align-items:center;justify-content:space-between;padding-top:24px;
            border-top:1px solid var(--border);
        }
        .kgv-btn-reply{
            background:var(--accent);color:#0A0C10;font-weight:600;font-size:0.85rem;
            padding:11px 20px;border-radius:2px;display:inline-flex;align-items:center;gap:8px;
        }
        .kgv-btn-reply:hover{background:#c49957;}
        .kgv-btn-delete{
            background:transparent;border:1px solid #4a3230;color:#e08b8b;font-size:0.85rem;font-weight:500;
            padding:11px 20px;border-radius:2px;cursor:pointer;font-family:inherit;
        }
        .kgv-btn-delete:hover{background:rgba(224,139,139,0.08);}
    </style>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 kgv-admin">

            <a href="{{ route('contacts.index') }}" class="kgv-back">
                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Retour aux messages
            </a>

            <div class="kgv-panel">
                <div class="kgv-msg-header">
                    <div>
                        <h1>{{ $contact->sujet ?? 'Message de contact' }}</h1>
                        <p>De : <strong style="color:var(--text);">{{ $contact->nom_expediteur }}</strong>
                            @if($contact->email_expediteur)
                                (<a href="mailto:{{ $contact->email_expediteur }}">{{ $contact->email_expediteur }}</a>)
                            @endif
                        </p>
                    </div>
                    <div class="kgv-date-badge">
                        {{ $contact->date_envoi ? \Illuminate\Support\Carbon::parse($contact->date_envoi)->format('d/m/Y à H:i') : 'Date non disponible' }}
                    </div>
                </div>

                <div class="kgv-msg-body">{{ $contact->message }}</div>

                <div class="kgv-msg-actions">
                    @if($contact->email_expediteur)
                        <div style="display:flex;gap:12px;align-items:center;">
                            <a href="mailto:{{ $contact->email_expediteur }}?subject=Re: {{ $contact->sujet ?? 'Votre message' }}" class="kgv-btn-reply">
                                Répondre par e-mail
                            </a>
                            <button type="button" id="copy-email-btn" data-email="{{ $contact->email_expediteur }}"
                                style="background:none;border:1px solid var(--border);color:var(--text-dim);font-size:0.85rem;padding:11px 16px;border-radius:2px;cursor:pointer;font-family:inherit;">
                                Copier l'e-mail
                            </button>
                        </div>
                    @else
                        <span></span>
                    @endif

                    <form action="{{ route('contacts.destroy', $contact) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer ce message ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="kgv-btn-delete">Supprimer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const copyBtn = document.getElementById('copy-email-btn');
        if (copyBtn) {
            copyBtn.addEventListener('click', () => {
                const email = copyBtn.dataset.email;
                navigator.clipboard.writeText(email).then(() => {
                    const originalText = copyBtn.textContent;
                    copyBtn.textContent = 'Copié !';
                    setTimeout(() => { copyBtn.textContent = originalText; }, 1500);
                });
            });
        }
    </script>
</x-app-layout>