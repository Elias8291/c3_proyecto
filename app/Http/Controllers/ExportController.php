<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Illuminate\Support\Facades\Response;
use App\Models\Estudiante;
class ExportController extends Controller
{
    public function exportStudents()
    {
        $writer = WriterEntityFactory::createXLSXWriter(); // Crea un escritor de XLSX
        $writer->openToBrowser('students.xlsx'); // Prepara el archivo para descargar

        $header = WriterEntityFactory::createRowFromArray(['Número de Control', 'Nombre', 'Apellido']);
        $writer->addRow($header); // Añade la fila de encabezados

        $estudiantes = Estudiante::all(); // Obtiene todos los estudiantes

        foreach ($estudiantes as $estudiante) {
            $row = WriterEntityFactory::createRowFromArray([
                $estudiante->numeroDeControl,
                $estudiante->nombre,
                $estudiante->apellido // Asegúrate de ajustar estos campos
            ]);
            $writer->addRow($row); // Añade cada fila de estudiante
        }

        $writer->close(); // Cierra el escritor, lo cual finaliza la descarga

        return Response::noContent(); // Retorna una respuesta vacía con status 204
    }
}
