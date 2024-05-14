@extends('layouts.master')
@section('title', 'FAQS')

@section('content')
    <div class="container pb-5">
        <div class="col-md-offset-1 col-md-12">
            <h1 class="text-center pt-5">Preguntas frecuentes</h1>
            <hr>
            </br>
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel-faqs panel-default">

                    <div class="panel-heading-faqs" role="tab" id="headingOne">
                        <h4 class="panel-title">
                            <a class="first" role="button" data-toggle="collapse" data-parent="#accordion"
                               href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                ¿Cómo puedo saber si mi solicitud de préstamo ha sido aprobada?
                                <span> </span>
                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel"
                         aria-labelledby="headingOne">
                        <div class="panel-body">
                            <p>Bueno, una vez que hayas enviado tu solicitud de préstamo, nuestro sistema se encargará de verificar si el equipo que solicitaste está disponible. Después de eso, te enviaremos un correo electrónico con toda la información sobre el estado de tu solicitud. Si tu solicitud es aprobada, te daremos instrucciones detalladas sobre cómo y dónde recoger el equipo que necesitas. ¡Así de sencillo! 😎</p>
                        </div>
                    </div>
                </div>
                <div class="panel-faqs panel-default">
                    <div class="panel-heading-faqs" role="tab" id="headingTwo">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                               href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                ¿Dónde puedo recoger y devolver el equipo que me prestaron?
                                <span> </span>
                            </a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                        <div class="panel-body">
                            <p>La entrega y devolución del equipo prestado se hace en un lugar específico que la institución ha designado. Una vez que tu solicitud sea aprobada, te darán información detallada sobre dónde tienes que ir para recoger y devolver el equipo. Asegúrate de seguir las instrucciones que te den para que todo salga bien y sin problemas. 😉</p>
                        </div>
                    </div>
                </div>

                <div class="panel-faqs panel-default">
                    <div class="panel-heading-faqs" role="tab" id="headingThree">
                        <h4 class="panel-title">
                            <a class="collapsed last" role="button" data-toggle="collapse" data-parent="#accordion"
                               href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Quiero cancelar mi préstamo. ¿Cómo lo hago?
                                <span> </span>
                            </a>
                        </h4>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel"
                         aria-labelledby="headingThree">
                        <div class="panel-body">
                            <p>Dentro de tu perfil se encuentra un botón con el cual podrás ver tu historial de préstamos, busca el más reciente y da al botón de cancelar, confirma y listo, no pasa nada 😁</p>
                        </div>
                    </div>
                </div>
                <div class="panel-faqsrtisan  panel-default">
                    <div class="panel-heading-faqs" role="tab" id="headingFour">
                        <h4 class="panel-title">
                            <a class="collapsed last" role="button" data-toggle="collapse" data-parent="#accordion"
                               href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                ¿Qué debo hacer si el equipo que necesito está en mal estado o no funciona correctamente cuando lo recibo?
                                <span> </span>
                            </a>
                        </h4>
                    </div>
                    <div id="collapseFour" class="panel-collapse collapse" role="tabpanel"
                         aria-labelledby="headingFour">
                        <div class="panel-body">
                            <p>Si el equipo que recibes está en mal estado o no funciona correctamente, por favor, informa inmediatamente al personal encargado del préstamo de equipos. Te proporcionarán asistencia adicional y, si es necesario, te ofrecerán un equipo de reemplazo según la disponibilidad. 🫥</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
