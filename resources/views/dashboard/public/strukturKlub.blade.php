@extends('layouts.public')
@section('content')

<style>
    /* RESET STYLES & HELPER CLASSES
–––––––––––––––––––––––––––––––––––––––––––––––––– */
:root {
  --level-1: #F0FFF0;
  --level-2: #F0FFF0;
  --level-3: #7b9fe0;
  --level-4: #f27c8d;
  --black: black;
}

* {
  padding: 0;
  margin: 0;
  box-sizing: border-box;
}

ol {
  list-style: none;
}

body {
  margin: 50px 0 100px;
  text-align: center;
  font-family: "Inter", sans-serif;
}


.rectangle {
  position: relative;
  padding: 20px;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
}


/* LEVEL-1 STYLES
–––––––––––––––––––––––––––––––––––––––––––––––––– */
.level-1 {
  width: 50%;
  margin: 0 auto 40px;
  background: var(--level-1);
}

.level-1::before {
  content: "";
  position: absolute;
  top: 100%;
  left: 50%;
  transform: translateX(-50%);
  width: 2px;
  height: 20px;
  background: var(--black);
}


/* LEVEL-2 STYLES
–––––––––––––––––––––––––––––––––––––––––––––––––– */
.level-2-wrapper {
  position: relative;
  display: grid;
  grid-template-columns: repeat(2, 1fr);
}

.level-2-wrapper::before {
  content: "";
  position: absolute;
  top: -20px;
  left: 26%;
  width: 50%;
  height: 2px;
  background: var(--black);
}

.level-2-wrapper li {
  position: relative;
}

.level-2-wrapper > li::before {
  content: "";
  position: absolute;
  bottom: 100%;
  left: 50%;
  transform: translateX(-50%);
  width: 2px;
  height: 20px;
  background: var(--black);
}

.level-2 {
  width: 90%;
  margin: 0 auto 40px;
  background: var(--level-2);
}

.level-2::before {
  content: "";
  position: absolute;
  top: 100%;
  left: 50%;
  transform: translateX(-50%);
  width: 2px;
  height: 20px;
  background: var(--black);
}

.page-footer {
  position: fixed;
  right: 0;
  bottom: 20px;
  display: flex;
  align-items: center;
  padding: 5px;
}

.page-footer a {
  margin-left: 4px;
}
</style>

<section class="page-section">
    <form action="{{route('showStrukturKlub', $id)}}">
        <h1 class="level-1 rectangle">
            <div class="center">
                <img src="{{asset('assets/img/struktur/'.$ketua[0]['img'])}}" style="height: 100px;" alt="image struktur">
            </div>
                {{ $ketua[0]['nama_sk'] }} 
            <span style = "display: block; color: #032A63">KETUA UMUM</span>
        </h1> 
        <ol class="level-2-wrapper">
            <li>
                <h2 class="level-2 rectangle">
                    <div class="center">
                        <img src="{{asset('assets/img/struktur/'.$sekretaris1[0]['img'])}}" style="height: 100px;" alt="image struktur">
                    </div>
                        {{ $sekretaris1[0]['nama_sk'] }}
                    <span style = "display: block; color: #032A63">SEKRETARIS I</span>
                </h2>
            </li>
            <li>
                <h2 class="level-2 rectangle">
                    <div class="center">
                        <img src="{{asset('assets/img/struktur/'.$bendahara1[0]['img'])}}" style="height: 100px;" alt="image struktur">
                    </div>
                        {{ $bendahara1[0]['nama_sk'] }} 
                    <span style = "display: block; color: #032A63">BENDAHARA I</span>
                </h2>
            </li>
            <li>
                <h2 class="level-2 rectangle">
                    <div class="center">
                        <img src="{{asset('assets/img/struktur/'.$sekretaris2[0]['img'])}}" style="height: 100px;" alt="image struktur">
                    </div>
                        {{ $sekretaris2[0]['nama_sk'] }}
                    <span style = "display: block; color: #032A63">SEKRETARIS II</span>
                </h2>
            </li>
            <li>
                <h2 class="level-2 rectangle">
                    <div class="center">
                        <img src="{{asset('assets/img/struktur/'.$bendahara2[0]['img'])}}" style="height: 100px;" alt="image struktur">
                    </div>
                        {{ $bendahara2[0]['nama_sk'] }}
                    <span style = "display: block; color: #032A63">BENDAHARA II</span>
                </h2>
            </li>
        </ol>
    
    </form>
</section>

@endsection

