@extends('layouts.layout')
@section('titulo-pagina', 'FastiFood - Linha do Tempo')
@section('conteudo-principal')
    <div id="main-wrapper">
        @include('layouts.header')
        <div class="content-body">
            <div class="container">
                <!-- row -->
                <div class="row timeline-wrapper">
                    <div class="col-xl-8 col-xxl-10 col-lg-10 my-auto mx-auto w-5/5">
                        <div class="card">
                            <div class="card-header border-0 pb-0">
                                <h4 class="card-title">Linha do tempo - Acompanhe seu pedido</h4>
                            </div>
                            <div class="card-body">
                                <div id="DZ_W_TimeLine" class="widget-timeline">
                                    <ul class="timeline">
                                        <li>
                                            <div class="loading-circle timeline-badge"></div>
                                            <a class="timeline-panel" href="#">
                                                <span>50 minutos atrás</span>
                                                <h6 class="mb-0">1ª Esperando o restaurante aceitar seu pedido.</h6>
                                            </a>
                                        </li>
                                        <li>
                                            <i class="check-icon timeline-badge fa-solid fa-circle-check"></i>
                                            <a class="timeline-panel completed" href="#">
                                                <span>50 minutos atrás</span>
                                                <h6 class="mb-0">2ª Pedido aceito! O restaurante está preparando seu
                                                    pedido.</h6>
                                            </a>
                                        </li>
                                        <li>
                                            <i class="check-icon timeline-badge fa-solid fa-circle-check"></i>
                                            <a class="timeline-panel completed" href="#">
                                                <span>40 minutos atrás</span>
                                                <h6 class="mb-0">3º Seu pedido está pronto! Aguardando entregador.</h6>
                                            </a>
                                        </li>
                                        <li>
                                            <i class="check-icon timeline-badge fa-solid fa-circle-check"></i>
                                            <a class="timeline-panel completed" href="#">
                                                <span>30 minutos atrás</span>
                                                <h6 class="mb-0">3º Entregador encontrado! Seu pedido saiu do
                                                    estabelecimento pra entregar até você.</h6>
                                                <button class="btn-location-delivery mt-3">
                                                    Acompanhe seu pedido
                                                    <svg fill="currentColor" viewBox="0 0 24 24" class="icon">
                                                        <path clip-rule="evenodd"
                                                            d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm4.28 10.28a.75.75 0 000-1.06l-3-3a.75.75 0 10-1.06 1.06l1.72 1.72H8.25a.75.75 0 000 1.5h5.69l-1.72 1.72a.75.75 0 101.06 1.06l3-3z"
                                                            fill-rule="evenodd"></path>
                                                    </svg>
                                                </button>
                                            </a>
                                        </li>
                                        <li>
                                            <i class="check-icon timeline-badge fa-solid fa-circle-check"></i>
                                            <a class="timeline-panel completed" href="#">
                                                <span>20 minutes atrás</span>
                                                <h6 class="mb-0">5º Seu pedido chegou na sua residência</h6>
                                            </a>
                                        </li>
                                        <li>
                                            <i class="check-icon timeline-badge fa-solid fa-circle-check"></i>
                                            <a class="timeline-panel completed" href="#">
                                                <span>Agora</span>
                                                <h6 class="mb-0">6º Entregue</h6>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footer')
    </div>
@endsection
