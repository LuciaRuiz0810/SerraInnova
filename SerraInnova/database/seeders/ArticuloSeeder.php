<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Articulo;
use App\Models\Usuario;
use Illuminate\Support\Str;

class ArticuloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener el primer administrador para asignarlo como autor
        $admin = Usuario::where('tipo_usuario', 'administrador')->first();
        
        if (!$admin) {
            $this->command->warn('No se encontró ningún administrador. Por favor, crea un usuario administrador primero.');
            return;
        }

        $articulos = [
            [
                'titulo' => 'Cómo ahorrar en la factura de luz con paneles solares',
                'slug' => Str::slug('Cómo ahorrar en la factura de luz con paneles solares'),
                'contenido' => '<p>La instalación de paneles solares en tu hogar puede reducir significativamente tu factura eléctrica. En este artículo, exploramos cómo funcionan los paneles solares, cuánto puedes ahorrar y qué considerar antes de la instalación.</p>

<h2>¿Cómo funcionan los paneles solares?</h2>
<p>Los paneles solares fotovoltaicos convierten la luz solar directamente en electricidad. Cuando los rayos del sol impactan las células fotovoltaicas, se genera una corriente eléctrica que puede utilizarse inmediatamente en tu hogar o almacenarse en baterías para uso posterior.</p>

<h2>Ahorro en la factura eléctrica</h2>
<p>Una instalación solar residencial típica puede reducir tu factura de luz entre un 50% y un 90%, dependiendo de:</p>
<ul>
<li>El tamaño de la instalación</li>
<li>Tu consumo energético</li>
<li>Las horas de sol en tu ubicación</li>
<li>La orientación de tu tejado</li>
</ul>

<h2>Retorno de la inversión</h2>
<p>Aunque la inversión inicial puede parecer alta (entre 4.000€ y 8.000€ para una vivienda unifamiliar), el periodo de amortización suele ser de 5 a 8 años. Considerando que los paneles tienen una vida útil de más de 25 años, el ahorro a largo plazo es considerable.</p>

<h2>Subvenciones disponibles</h2>
<p>En España, existen varias ayudas para la instalación de paneles solares, incluyendo las subvenciones de los fondos Next Generation EU que pueden cubrir hasta el 40% del coste de la instalación.</p>',
                'extracto' => 'Descubre cómo la instalación de paneles solares puede reducir tu factura eléctrica entre un 50% y 90%, con un periodo de amortización de 5-8 años.',
                'imagen_destacada' => 'https://images.pexels.com/photos/433308/pexels-photo-433308.jpeg?auto=compress&cs=tinysrgb&w=800',
                'categoria' => 'ahorro_energetico',
                'autor_id' => $admin->id_usuario,
                'publicado' => true,
                'fecha_publicacion' => now()->subDays(10),
            ],
            [
                'titulo' => 'Guía completa de subvenciones 2026 para energía renovable',
                'slug' => Str::slug('Guía completa de subvenciones 2026 para energía renovable'),
                'contenido' => '<p>Para 2026, el gobierno ha ampliado las ayudas para la instalación de sistemas de energía renovable en viviendas. Esta guía te ayudará a entender qué subvenciones están disponibles y cómo solicitarlas.</p>

<h2>Programa de Incentivos para Autoconsumo</h2>
<p>El programa principal incluye ayudas para:</p>
<ul>
<li>Instalaciones de autoconsumo con renovables (hasta 600€/kWp)</li>
<li>Sistemas de almacenamiento con baterías (hasta 490€/kWh)</li>
<li>Climatización con energías renovables (hasta 1.000€/kW)</li>
</ul>

<h2>Deducciones fiscales en el IRPF</h2>
<p>Además de las subvenciones directas, puedes deducir en tu declaración de la renta:</p>
<ul>
<li>20% por mejoras que reduzcan la demanda de calefacción/refrigeración</li>
<li>40% por mejoras que reduzcan el consumo de energía primaria no renovable</li>
<li>60% para obras de rehabilitación energética</li>
</ul>

<h2>Cómo solicitar las ayudas</h2>
<p>El proceso general incluye:</p>
<ol>
<li>Solicitar presupuestos a instaladores certificados</li>
<li>Presentar la solicitud en tu comunidad autónoma</li>
<li>Esperar la aprobación (2-4 meses típicamente)</li>
<li>Realizar la instalación</li>
<li>Presentar la justificación de la inversión</li>
</ol>

<h2>Plazos importantes</h2>
<p>Las solicitudes para 2026 se pueden presentar desde enero hasta agotar presupuesto. Se recomienda solicitarlas lo antes posible, ya que las ayudas se conceden por orden de llegada.</p>',
                'extracto' => 'Conoce todas las subvenciones disponibles en 2026 para energía renovable, incluyendo ayudas de hasta 600€/kWp y deducciones fiscales de hasta el 60%.',
                'imagen_destacada' => 'https://images.pexels.com/photos/259027/pexels-photo-259027.jpeg?auto=compress&cs=tinysrgb&w=800',
                'categoria' => 'subvenciones',
                'autor_id' => $admin->id_usuario,
                'publicado' => true,
                'fecha_publicacion' => now()->subDays(5),
            ],
            [
                'titulo' => 'Domótica verde: tecnología para un hogar sostenible',
                'slug' => Str::slug('Domótica verde: tecnología para un hogar sostenible'),
                'contenido' => '<p>La domótica verde combina la automatización del hogar con la eficiencia energética, permitiéndote reducir tu consumo mientras mejoras tu comodidad.</p>

<h2>¿Qué es la domótica verde?</h2>
<p>La domótica verde se centra en sistemas inteligentes que optimizan el consumo de recursos en tu hogar:</p>
<ul>
<li>Termostatos inteligentes que ajustan la temperatura automáticamente</li>
<li>Iluminación LED controlada por sensores de presencia</li>
<li>Persianas motorizadas que regulan la temperatura según la hora del día</li>
<li>Electrodomésticos que funcionan en horarios de menor coste energético</li>
</ul>

<h2>Sistemas más populares</h2>

<h3>Control de climatización</h3>
<p>Los termostatos inteligentes como Nest o Ecobee aprenden tus rutinas y ajustan la temperatura automáticamente, reduciendo el consumo hasta un 23% en calefacción y 15% en refrigeración.</p>

<h3>Iluminación inteligente</h3>
<p>Las bombillas LED controladas por apps o sensores pueden reducir el consumo de iluminación hasta un 75% comparado con bombillas tradicionales.</p>

<h3>Gestión de energía</h3>
<p>Los sistemas de monitorización energética te muestran en tiempo real dónde y cuándo consumes más energía, permitiéndote tomar decisiones informadas.</p>

<h2>Integración con energía solar</h2>
<p>La domótica verde funciona especialmente bien con instalaciones solares, permitiendo:</p>
<ul>
<li>Programar electrodomésticos para funcionar cuando hay más producción solar</li>
<li>Gestionar baterías de forma eficiente</li>
<li>Vender excedentes a la red en momentos óptimos</li>
</ul>

<h2>Inversión y ahorro</h2>
<p>Una instalación básica de domótica verde puede costar entre 1.000€ y 3.000€, con ahorros anuales de 200€ a 500€ en facturas de servicios.</p>',
                'extracto' => 'Explora cómo la domótica verde puede ayudarte a reducir tu consumo energético hasta un 23% mientras aumentas el confort de tu hogar.',
                'imagen_destacada' => 'https://images.pexels.com/photos/1571460/pexels-photo-1571460.jpeg?auto=compress&cs=tinysrgb&w=800',
                'categoria' => 'domotica_verde',
                'autor_id' => $admin->id_usuario,
                'publicado' => true,
                'fecha_publicacion' => now()->subDays(3),
            ],
            [
                'titulo' => 'Agenda 2030: Objetivos de desarrollo sostenible en el sector inmobiliario',
                'slug' => Str::slug('Agenda 2030: Objetivos de desarrollo sostenible en el sector inmobiliario'),
                'contenido' => '<p>La Agenda 2030 y sus 17 Objetivos de Desarrollo Sostenible (ODS) están transformando el sector inmobiliario hacia prácticas más responsables y sostenibles.</p>

<h2>ODS más relevantes para el sector inmobiliario</h2>

<h3>ODS 7: Energía asequible y no contaminante</h3>
<p>El sector inmobiliario está adoptando:</p>
<ul>
<li>Certificaciones energéticas más estrictas</li>
<li>Instalaciones de energía renovable en nuevas construcciones</li>
<li>Rehabilitación energética de edificios existentes</li>
</ul>

<h3>ODS 11: Ciudades y comunidades sostenibles</h3>
<p>Se promueven desarrollos urbanos que incluyen:</p>
<ul>
<li>Espacios verdes y áreas peatonales</li>
<li>Transporte público accesible</li>
<li>Viviendas asequibles y eficientes</li>
</ul>

<h3>ODS 13: Acción por el clima</h3>
<p>El sector se compromete a reducir emisiones mediante:</p>
<ul>
<li>Construcción con materiales sostenibles</li>
<li>Diseño bioclimático</li>
<li>Sistemas de gestión de residuos eficientes</li>
</ul>

<h2>Certificaciones sostenibles</h2>
<p>Existen varias certificaciones que garantizan la sostenibilidad de las edificaciones:</p>
<ul>
<li><strong>LEED</strong>: Liderazgo en Energía y Diseño Ambiental</li>
<li><strong>BREEAM</strong>: Método de Evaluación Ambiental</li>
<li><strong>Passivhaus</strong>: Estándar de construcción de bajo consumo energético</li>
<li><strong>VERDE</strong>: Certificación española de edificación sostenible</li>
</ul>

<h2>Beneficios para propietarios e inversores</h2>
<p>Las propiedades sostenibles ofrecen:</p>
<ul>
<li>Mayor valor de reventa (10-15% más que propiedades convencionales)</li>
<li>Menores costes operativos (hasta 30% menos en facturas)</li>
<li>Mayor atractivo para inquilinos conscientes</li>
<li>Acceso a financiación verde con mejores condiciones</li>
</ul>

<h2>El futuro del sector inmobiliario</h2>
<p>Para 2030, se espera que todas las nuevas construcciones sean de consumo casi nulo (NZEB), y que se rehabilite energéticamente al menos el 35% del parque inmobiliario existente.</p>',
                'extracto' => 'Descubre cómo la Agenda 2030 está transformando el sector inmobiliario hacia la sostenibilidad y qué beneficios aporta a propietarios e inversores.',
                'imagen_destacada' => 'https://images.pexels.com/photos/280221/pexels-photo-280221.jpeg?auto=compress&cs=tinysrgb&w=800',
                'categoria' => 'agenda_2030',
                'autor_id' => $admin->id_usuario,
                'publicado' => true,
                'fecha_publicacion' => now()->subDay(),
            ],
            [
                'titulo' => 'Cómo reducir el consumo de agua en tu hogar',
                'slug' => Str::slug('Cómo reducir el consumo de agua en tu hogar'),
                'contenido' => '<p>El agua es un recurso cada vez más escaso. Con pequeños cambios en tu hogar, puedes reducir significativamente tu consumo y contribuir a la sostenibilidad del planeta.</p>

<h2>Sistemas de ahorro de agua</h2>

<h3>Grifería eficiente</h3>
<p>Los aireadores y limitadores de caudal pueden reducir el consumo de agua en grifos hasta un 50% sin afectar la comodidad de uso. Cuestan entre 5€ y 20€ y se instalan fácilmente.</p>

<h3>Inodoros de doble descarga</h3>
<p>Los inodoros modernos con sistema de doble descarga (3/6 litros) pueden ahorrar hasta 20.000 litros de agua al año por persona comparado con inodoros antiguos (9-12 litros por descarga).</p>

<h3>Duchas de bajo consumo</h3>
<p>Las alcachofas de ducha eco pueden reducir el consumo de 15-20 litros/minuto a 6-9 litros/minuto, manteniendo una sensación agradable gracias a su diseño optimizado.</p>

<h2>Electrodomésticos eficientes</h2>
<p>Al renovar electrodomésticos, elige modelos con clasificación A o superior:</p>
<ul>
<li><strong>Lavadoras</strong>: Los modelos A+++ consumen 40% menos agua que los estándar</li>
<li><strong>Lavavajillas</strong>: Un lavavajillas eficiente usa menos agua que lavar a mano (10L vs 40L)</li>
</ul>

<h2>Reutilización de agua</h2>

<h3>Sistemas de aguas grises</h3>
<p>El agua de duchas y lavabos puede reutilizarse para:</p>
<ul>
<li>Riego de jardines</li>
<li>Descarga de inodoros</li>
<li>Limpieza de exteriores</li>
</ul>

<h3>Recogida de agua de lluvia</h3>
<p>Un sistema básico de recogida de agua de lluvia puede proporcionar 40-80 litros por metro cuadrado de tejado al año, ideal para riego.</p>

<h2>Hábitos sostenibles</h2>
<p>Pequeños cambios en tus hábitos pueden generar grandes ahorros:</p>
<ul>
<li>Cerrar el grifo mientras te cepillas los dientes (ahorra 12L/día)</li>
<li>Duchas de 5 minutos en lugar de 10 (ahorra 45L por ducha)</li>
<li>Lavar ropa y vajilla con carga completa (ahorra 15-20L por lavado)</li>
<li>Revisar y reparar fugas regularmente (una fuga puede desperdiciar 30L/día)</li>
</ul>

<h2>Ahorro económico</h2>
<p>Implementando estas medidas, una familia de 4 personas puede ahorrar:</p>
<ul>
<li>Entre 50 y 100 m³ de agua al año</li>
<li>Aproximadamente 150€-300€ anuales en la factura del agua</li>
<li>Reducción adicional en la factura energética por menos agua caliente</li>
</ul>',
                'extracto' => 'Aprende a reducir el consumo de agua en tu hogar con sistemas eficientes y hábitos sostenibles, ahorrando hasta 300€ al año.',
                'imagen_destacada' => 'https://images.pexels.com/photos/416528/pexels-photo-416528.jpeg?auto=compress&cs=tinysrgb&w=800',
                'categoria' => 'ahorro_energetico',
                'autor_id' => $admin->id_usuario,
                'publicado' => true,
                'fecha_publicacion' => now(),
            ],
        ];

        foreach ($articulos as $articulo) {
            Articulo::create($articulo);
        }

        $this->command->info('Se han creado 5 artículos de ejemplo correctamente.');
    }
}
