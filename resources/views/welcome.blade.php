<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ $user->nom ?? 'Okafor Ann Chidera' }} — Portfolio</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<style>
  :root{
    --bg: #0A0C10;
    --surface: #13161C;
    --border: #22262E;
    --text: #ECEDEE;
    --text-dim: #92979F;
    --accent: #B08949;
    --accent-dim: #8A6C3A;
  }
  *{margin:0;padding:0;box-sizing:border-box;}
  body{
    background:var(--bg);
    color:var(--text);
    font-family:'Inter',sans-serif;
    line-height:1.6;
    -webkit-font-smoothing:antialiased;
  }
  h1,h2,h3,h4{
    font-family:'Fraunces',serif;
    font-weight:500;
    letter-spacing:-0.01em;
  }
  a{color:inherit;text-decoration:none;}
  .wrap{max-width:1100px;margin:0 auto;padding:0 32px;}

  /* NAV */
  nav{
    position:sticky;top:0;z-index:50;
    background:rgba(10,12,16,0.85);
    backdrop-filter:blur(8px);
    border-bottom:1px solid var(--border);
  }
  nav .wrap{
    height:72px;display:flex;align-items:center;justify-content:space-between;
  }
  .brand{
    font-family:'Fraunces',serif;font-size:1.05rem;font-weight:500;
    display:flex;align-items:center;gap:10px;
  }
  .brand-mark{
    width:30px;height:30px;border:1px solid var(--accent);border-radius:2px;
    display:flex;align-items:center;justify-content:center;
    font-size:0.75rem;color:var(--accent);font-family:'Fraunces',serif;
    overflow:hidden;
  }
  .brand-mark img{width:100%;height:100%;object-fit:cover;}
  .navlinks{display:flex;gap:32px;font-size:0.875rem;color:var(--text-dim);}
  .navlinks a:hover{color:var(--text);}
  .nav-right{display:flex;align-items:center;gap:14px;}
  .nav-cta, .nav-admin{
    font-size:0.8rem;padding:9px 18px;border:1px solid var(--border);border-radius:2px;
    color:var(--text);transition:border-color .2s;
  }
  .nav-cta:hover, .nav-admin:hover{border-color:var(--accent);}
  .nav-cta{background:var(--accent);color:#0A0C10;font-weight:600;border-color:var(--accent);}
  .nav-cta:hover{background:#c49957;}

  /* HERO */
  .hero{
    position:relative;
    min-height:auto;
    display:block;
    overflow:hidden;
    border-bottom:1px solid var(--border);
  }
  .hero-grid-bg{
    position:absolute;inset:0;
    background-image:
      linear-gradient(var(--border) 1px, transparent 1px),
      linear-gradient(90deg, var(--border) 1px, transparent 1px);
    background-size:64px 64px;
    opacity:0.35;
    mask-image: radial-gradient(ellipse 70% 60% at 50% 0%, black 20%, transparent 75%);
  }
  .hero-content{position:relative;z-index:1;padding:24px 0 96px;}
  .hero-eyebrow{
    font-size:0.85rem;color:var(--accent);margin-bottom:20px;
    display:flex;align-items:center;gap:10px;
  }
  .hero-eyebrow .dot{width:6px;height:6px;border-radius:50%;background:var(--accent);}
  .hero-type{
    font-family:'Fraunces',serif;font-weight:500;color:var(--accent);
    font-size:clamp(1.4rem, 3vw, 2rem);margin-bottom:18px;
    min-height:1.4em;
  }
  .hero-type .cursor{
    display:inline-block;width:2px;height:1em;background:var(--accent);
    margin-left:2px;vertical-align:-0.15em;animation:blink 0.9s step-end infinite;
  }
  @keyframes blink{50%{opacity:0;}}
  h1.hero-title{
    font-size:clamp(2.6rem, 6vw, 4.6rem);
    line-height:1.05;
    max-width:16ch;
    margin-bottom:28px;
  }
  .hero-lede{
    font-size:1.1rem;color:var(--text-dim);max-width:52ch;margin-bottom:36px;
  }
  .hero-actions{display:flex;gap:16px;align-items:center;}
  .btn-primary{
    background:var(--accent);color:#0A0C10;font-weight:600;font-size:0.9rem;
    padding:13px 26px;border-radius:2px;transition:background .2s;
  }
  .btn-primary:hover{background:#c49957;}
  .btn-ghost{
    font-size:0.9rem;color:var(--text-dim);border-bottom:1px solid var(--border);padding-bottom:2px;
    transition:color .2s, border-color .2s;
  }
  .btn-ghost:hover{color:var(--text);border-color:var(--text);}

  /* SECTION SHELL */
  section{padding:120px 0;border-bottom:1px solid var(--border);}
  .section-head{
    display:flex;justify-content:space-between;align-items:flex-end;
    margin-bottom:64px;gap:24px;flex-wrap:wrap;
  }
  .section-head h2{font-size:2rem;}
  .section-head p{color:var(--text-dim);max-width:38ch;font-size:0.95rem;}

  /* ABOUT */
  .about-grid{display:grid;grid-template-columns:0.9fr 1.4fr;gap:80px;align-items:start;}
  .about-photo{
    aspect-ratio:4/5;border:1px solid var(--border);border-radius:2px;
    background:linear-gradient(160deg, #191d24, #0d0f13);
    display:flex;align-items:center;justify-content:center;
    color:var(--text-dim);font-size:0.8rem;overflow:hidden;
  }
  .about-photo img{width:100%;height:100%;object-fit:cover;}
  .about-facts{margin-top:28px;font-size:0.85rem;}
  .about-facts div{
    display:flex;justify-content:space-between;padding:12px 0;border-top:1px solid var(--border);
    gap:16px;
  }
  .about-facts span:first-child{color:var(--text-dim);flex-shrink:0;}
  .about-facts span:last-child{text-align:right;}
  .about-text p{margin-bottom:22px;color:#c7cad0;max-width:58ch;}
  .about-text p:first-child{font-size:1.15rem;color:var(--text);}

  /* SKILLS */
  .skill-row{
    display:grid;grid-template-columns:200px 1fr 90px;gap:20px;align-items:center;
    padding:16px 0;border-top:1px solid var(--border);
  }
  .skill-row:last-child{border-bottom:1px solid var(--border);}
  .skill-name{font-size:0.95rem;}
  .skill-track{height:2px;background:var(--border);position:relative;border-radius:1px;}
  .skill-fill{position:absolute;left:0;top:0;height:100%;background:var(--accent);border-radius:1px;}
  .skill-level-label{font-size:0.8rem;color:var(--text-dim);text-align:right;}
  .empty-note{color:var(--text-dim);font-size:0.9rem;}

  /* PROJECTS */
  .flagship{
    display:grid;grid-template-columns:1.1fr 0.9fr;gap:56px;align-items:center;
    padding-bottom:64px;margin-bottom:64px;border-bottom:1px solid var(--border);
  }
  .flagship-visual{
    aspect-ratio:16/11;border:1px solid var(--border);border-radius:2px;
    background:linear-gradient(160deg,#171b21,#0d0f13);overflow:hidden;
  }
  .flagship-visual img{width:100%;height:100%;object-fit:cover;}
  .proj-type{font-size:0.8rem;color:var(--accent);margin-bottom:10px;}
  .flagship h3{font-size:1.7rem;margin-bottom:14px;}
  .flagship p{color:var(--text-dim);margin-bottom:22px;max-width:44ch;}
  .stack-list{display:flex;gap:8px;flex-wrap:wrap;margin-bottom:24px;}
  .stack-tag{
    font-size:0.75rem;color:var(--text-dim);border:1px solid var(--border);
    padding:5px 12px;border-radius:2px;
  }
  .proj-links{display:flex;gap:24px;}
  .proj-links a{font-size:0.85rem;border-bottom:1px solid var(--border);padding-bottom:2px;color:var(--text-dim);}
  .proj-links a:hover{color:var(--text);border-color:var(--text);}

  .proj-list-item{
    display:grid;grid-template-columns:2fr 3fr 1fr;gap:24px;align-items:center;
    padding:22px 0;border-top:1px solid var(--border);
  }
  .proj-list-item:last-child{border-bottom:1px solid var(--border);}
  .proj-list-item h4{font-size:1.05rem;font-weight:500;}
  .proj-list-item p{color:var(--text-dim);font-size:0.88rem;}
  .proj-list-item .proj-links{justify-content:flex-end;}

  /* EXPERIENCE */
  .timeline{position:relative;padding-left:32px;}
  .timeline::before{
    content:'';position:absolute;left:0;top:6px;bottom:6px;width:1px;background:var(--border);
  }
  .tl-item{position:relative;padding-bottom:48px;}
  .tl-item:last-child{padding-bottom:0;}
  .tl-item::before{
    content:'';position:absolute;left:-36px;top:6px;width:9px;height:9px;border-radius:50%;
    background:var(--bg);border:1px solid var(--accent);
  }
  .tl-date{font-size:0.8rem;color:var(--accent);margin-bottom:8px;}
  .tl-item h4{font-size:1.15rem;margin-bottom:4px;}
  .tl-org{font-size:0.85rem;color:var(--text-dim);margin-bottom:12px;}
  .tl-item p{color:#c7cad0;max-width:56ch;font-size:0.92rem;}

  /* CONTACT */
  .contact-grid{display:grid;grid-template-columns:1fr 1fr;gap:80px;align-items:center;}
  .contact-grid h2{font-size:2.4rem;line-height:1.15;margin-bottom:20px;}
  .contact-grid > div:first-child p{color:var(--text-dim);max-width:42ch;margin-bottom:28px;}
  .contact-email{
    font-size:1.05rem;border-bottom:1px solid var(--accent);padding-bottom:4px;color:var(--accent);
  }
  form{display:flex;flex-direction:column;gap:18px;}
  label{font-size:0.8rem;color:var(--text-dim);margin-bottom:6px;display:block;}
  input, textarea{
    width:100%;background:var(--surface);border:1px solid var(--border);color:var(--text);
    padding:12px 14px;border-radius:2px;font-family:inherit;font-size:0.9rem;
  }
  input:focus, textarea:focus{outline:none;border-color:var(--accent);}
  button[type=submit]{
    align-self:flex-start;background:var(--accent);color:#0A0C10;font-weight:600;font-size:0.9rem;
    padding:13px 28px;border:none;border-radius:2px;cursor:pointer;margin-top:6px;
  }
  .form-error{color:#e08b8b;font-size:0.8rem;margin-top:-10px;}
  .form-success{
    background:rgba(176,137,73,0.1);border:1px solid var(--accent);color:var(--accent);
    padding:14px 18px;border-radius:2px;margin-bottom:24px;font-size:0.9rem;
  }

  footer{padding:40px 0;display:flex;justify-content:space-between;font-size:0.8rem;color:var(--text-dim);flex-wrap:wrap;gap:12px;}

  @media(max-width:860px){
    .about-grid, .flagship, .contact-grid{grid-template-columns:1fr;}
    .proj-list-item{grid-template-columns:1fr;gap:8px;}
    .proj-list-item .proj-links{justify-content:flex-start;}
    .navlinks{display:none;}
  }
</style>
</head>
<body>

<nav>
  <div class="wrap">
    <a href="#" class="brand">
      <span class="brand-mark">
        @if(!empty($user->photo_profil))
          <img src="{{ Storage::url($user->photo_profil) }}" alt="{{ $user->nom }}">
        @else
          {{ collect(explode(' ', $user->nom ?? 'O A'))->map(fn($w) => mb_substr($w,0,1))->join('') }}
        @endif
      </span>
      {{ $user->nom ?? 'Okafor Ann Chidera' }}
    </a>
    <div class="navlinks">
      <a href="#apropos">À propos</a>
      <a href="#competences">Compétences</a>
      <a href="#projets">Projets</a>
      <a href="#experience">Expérience</a>
    </div>
    <div class="nav-right">
      @auth
        <a href="{{ route('projets.index') }}" class="nav-admin">Administration</a>
      @else
        <a href="{{ route('login') }}" class="nav-admin">Connexion</a>
      @endauth
      <a href="#contact" class="nav-cta">Me contacter</a>
    </div>
  </div>
</nav>

<section class="hero">
  <div class="hero-grid-bg"></div>
  <div class="wrap hero-content">
    <div class="hero-eyebrow"><span class="dot"></span> Disponible pour de nouveaux projets</div>
    <div class="hero-type" id="typewriter"><span id="typewriter-text"></span><span class="cursor"></span></div>
    <h1 class="hero-title">{{ $user->titre_professionnel ?? 'Développeuse full-stack, orientée architecture logicielle.' }}</h1>
    <p class="hero-lede">
      {{ $user->bio ?? "Je conçois des systèmes web robustes avec Laravel et Node.js." }}
    </p>
    <div class="hero-actions">
      <a href="#projets" class="btn-primary">Voir mes projets</a>
      <a href="#contact" class="btn-ghost">Me contacter</a>
    </div>
  </div>
</section>

<section id="apropos">
  <div class="wrap">
    <div class="about-grid">
      <div>
        <div class="about-photo">
          @if(!empty($user->photo_profil))
            <img src="{{ Storage::url($user->photo_profil) }}" alt="{{ $user->nom }}">
          @else
            photo
          @endif
        </div>
        <div class="about-facts">
          <div><span>Localisation</span><span>Abidjan, Côte d'Ivoire</span></div>
          @if(!empty($user->telephone))
            <div><span>Téléphone</span><span>{{ $user->telephone }}</span></div>
          @endif
          <div><span>Email</span><span>{{ $user->email ?? '—' }}</span></div>
          <div><span>Statut</span><span>Ouverte aux opportunités</span></div>
        </div>
      </div>
      <div class="about-text">
        @if(!empty($user->bio))
          <p>{{ $user->bio }}</p>
        @else
          <p>Je transforme des problématiques complexes en architectures logicielles propres,
          maintenables et intuitives.</p>
          <p>Que ce soit pour le backend avec Laravel et Node.js ou la conception d'interfaces
          modernes, je m'investis pleinement pour livrer du code de haute qualité.</p>
        @endif
      </div>
    </div>
  </div>
</section>

<section id="competences">
  <div class="wrap">
    <div class="section-head">
      <h2>Compétences</h2>
      <p>Les outils et langages que j'utilise au quotidien, du backend à l'interface.</p>
    </div>

    @forelse($skills as $skill)
      <div class="skill-row">
        <div class="skill-name">{{ $skill->titre }}</div>
        <div class="skill-track">
          <div class="skill-fill" style="width: {{ is_numeric($skill->niveau) ? $skill->niveau : 70 }}%"></div>
        </div>
        <div class="skill-level-label">{{ $skill->niveau }}</div>
      </div>
    @empty
      <p class="empty-note">Aucune compétence renseignée pour l'instant.</p>
    @endforelse
  </div>
</section>

<section id="projets">
  <div class="wrap">
    <div class="section-head">
      <h2>Projets</h2>
      <p>Réalisations récentes, du logiciel métier complet à l'application web ciblée.</p>
    </div>

    @forelse($projects as $index => $project)
      @if($index === 0)
        <div class="flagship">
          <div class="flagship-visual">
            @if(!empty($project->image))
              <img src="{{ Storage::url($project->image) }}" alt="{{ $project->titre }}">
            @endif
          </div>
          <div>
            <p class="proj-type">Projet principal</p>
            <h3>{{ $project->titre }}</h3>
            <p>{{ $project->description }}</p>
            <div class="proj-links">
              @if(!empty($project->lien_demo))
                <a href="{{ $project->lien_demo }}" target="_blank">Voir le projet</a>
              @endif
              @if(!empty($project->lien_github))
                <a href="{{ $project->lien_github }}" target="_blank">GitHub</a>
              @endif
            </div>
          </div>
        </div>
      @else
        <div class="proj-list-item">
          <h4>{{ $project->titre }}</h4>
          <p>{{ Illuminate\Support\Str::limit($project->description, 100) }}</p>
          <div class="proj-links">
            @if(!empty($project->lien_demo))
              <a href="{{ $project->lien_demo }}" target="_blank">Démo</a>
            @endif
            @if(!empty($project->lien_github))
              <a href="{{ $project->lien_github }}" target="_blank">GitHub</a>
            @endif
          </div>
        </div>
      @endif
    @empty
      <p class="empty-note">Aucun projet renseigné pour l'instant.</p>
    @endforelse
  </div>
</section>

<section id="experience">
  <div class="wrap">
    <div class="section-head">
      <h2>Expérience</h2>
      <p>Parcours professionnel et formation.</p>
    </div>

    @forelse($experiences as $exp)
      <div class="timeline">
        <div class="tl-item">
          <div class="tl-date">
            {{ \Carbon\Carbon::parse($exp->date_debut)->format('Y') }}
            @if($exp->date_fin)
              — {{ \Carbon\Carbon::parse($exp->date_fin)->format('Y') }}
            @else
              — Aujourd'hui
            @endif
          </div>
          <h4>{{ $exp->poste_ou_diplome }}</h4>
          <div class="tl-org">{{ $exp->entreprise }}</div>
          <p>{{ $exp->description }}</p>
        </div>
      </div>
    @empty
      <p class="empty-note">Aucune expérience renseignée pour l'instant.</p>
    @endforelse
  </div>
</section>

<section id="contact" style="border-bottom:none;">
  <div class="wrap">
    <div class="contact-grid">
      <div>
        <h2>Construisons quelque chose ensemble.</h2>
        <p>Un projet, une idée, une opportunité ? Je suis disponible pour en discuter.</p>
        <a href="mailto:{{ $user->email ?? 'contact@example.com' }}" class="contact-email">{{ $user->email ?? 'contact@example.com' }}</a>
      </div>
      <div>
        @if(session('success'))
          <div class="form-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('contact.store') }}" method="POST">
          @csrf
          <input type="hidden" name="user_id" value="{{ $user->id ?? 1 }}">

          <div>
            <label for="nom_expediteur">Votre nom</label>
            <input type="text" name="nom_expediteur" id="nom_expediteur" value="{{ old('nom_expediteur') }}" placeholder="John Doe" required>
            @error('nom_expediteur') <div class="form-error">{{ $message }}</div> @enderror
          </div>
          <div>
            <label for="email_expediteur">Votre e-mail</label>
            <input type="email" name="email_expediteur" id="email_expediteur" value="{{ old('email_expediteur') }}" placeholder="john@example.com">
            @error('email_expediteur') <div class="form-error">{{ $message }}</div> @enderror
          </div>
          <div>
            <label for="sujet">Sujet</label>
            <input type="text" name="sujet" id="sujet" value="{{ old('sujet') }}" placeholder="Collaboration / Opportunité..." required>
            @error('sujet') <div class="form-error">{{ $message }}</div> @enderror
          </div>
          <div>
            <label for="message">Message</label>
            <textarea name="message" id="message" rows="4" placeholder="Décrivez votre besoin..." required>{{ old('message') }}</textarea>
            @error('message') <div class="form-error">{{ $message }}</div> @enderror
          </div>
          <button type="submit">Envoyer le message</button>
        </form>
      </div>
    </div>
  </div>
</section>

<footer>
  <div class="wrap" style="display:flex;justify-content:space-between;width:100%;flex-wrap:wrap;gap:12px;">
    <span>&copy; {{ date('Y') }} {{ $user->nom ?? 'Okafor Ann Chidera' }}</span>
    <span>Abidjan, Côte d'Ivoire</span>
  </div>
</footer>

<script>
  const words = ['Laravel', 'Node.js', 'Architecture logicielle', 'Full-Stack'];
  const el = document.getElementById('typewriter-text');
  let wordIndex = 0, charIndex = 0, deleting = false;

  function tick(){
    const current = words[wordIndex];
    if(!deleting){
      charIndex++;
      el.textContent = current.slice(0, charIndex);
      if(charIndex === current.length){
        deleting = true;
        setTimeout(tick, 1400);
        return;
      }
    } else {
      charIndex--;
      el.textContent = current.slice(0, charIndex);
      if(charIndex === 0){
        deleting = false;
        wordIndex = (wordIndex + 1) % words.length;
      }
    }
    setTimeout(tick, deleting ? 40 : 70);
  }
  tick();
</script>

</body>
</html>