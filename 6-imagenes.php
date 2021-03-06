<?php
/**
 * Trabajar con documentos de Word y PHP usando PHPOffice
 *
 * Más tutoriales en: parzibyte.me/blog
 *
 * Ejemplo 6:
 * Agregar imágenes
 * Nota: se utiliza la notación corta de arreglos [], que se pueden remplazar por array(),
 * más información en https://parzibyte.me/blog/2018/10/11/sintaxis-corta-array-php/
 */
require_once "vendor/autoload.php";
use PhpOffice\PhpWord\Style\Language;
$documento = new \PhpOffice\PhpWord\PhpWord();
$propiedades = $documento->getDocInfo();
$propiedades->setCreator("Luis Cabrera Benito");
$propiedades->setTitle("Imágenes");

$seccion = $documento->addSection();
# Títulos. Solo modificando depth (el número)
$fuenteTitulo = [
    "name" => "Verdana",
    "size" => 20,
    "color" => "000000",
];
$documento->addTitleStyle(1, $fuenteTitulo);
$seccion->addTitle("Gopher", 1);
$seccion->addImage("gopher-2661632_640.jpg", [
    "width" => 100,
]);
$seccion->addText("Los geómidos son una familia de roedores castorimorfos conocidos vulgarmente como tuzas, taltuzas o ratas de abazones. Se encuentran en Canadá, Estados Unidos, México, América Central y Colombia. En México habitan seis especies que se encuentran en peligro de extinción. ");

$seccion->addTitle("Conejo", 1);
$seccion->addImage("conejo.jpg", [
    "width" => 320,
    "height" => 213,
]);
$seccion->addText("El conejo común o conejo europeo es una especie de mamífero lagomorfo de la familia Leporidae, y el único miembro actual del género Oryctolagus. Está incluido en la lista 100 de las especies exóticas invasoras más dañinas del mundo​ de la Unión Internacional para la Conservación de la Naturaleza.");

$seccion->addTitle("Imagen aleatoria de internet", 1);
$seccion->addImage("https://picsum.photos/200/300", [
    "width" => 200,
    "height" => 300,
]);
$seccion->addText("Lo de arriba es una imagen de internet");

# Para que no diga que se abre en modo de compatibilidad
$documento->getCompatibility()->setOoxmlVersion(15);
# Idioma español de México
$documento->getSettings()->setThemeFontLang(new Language("ES-MX"));

# Guardarlo
$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($documento, "Word2007");

$objWriter->save("6-imagenes.docx");
