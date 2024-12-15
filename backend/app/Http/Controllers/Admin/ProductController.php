<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    // Mostrar una lista del recurso    
    public function index()
    {
        // Retornar y pasar los productoes a la view
        return view('admin.products.index')->with([
            // obtiene los colores y tamaños asociados al producto creado mas reciente al mas antiguo
            'products' => Product::with(['colors', 'sizes'])->latest()->get()
        ]);
    }

    // Mostrar el formulario para crear un nuevo recurso
    public function create()
    {
        // En este form necesito que muestre la lista de los tamaños y colores disponibles 
        $colors = Color::all();
        $sizes = Size::all();
        // Esta informacion debo enviar a la vista
        return view('admin.products.create')->with([
            'colors' => $colors,
            'sizes' => $sizes
        ]);
    }

    // Guardar un producto recien creado en la DB
    // Pasar la instancia de la clase AddProductRequest que se creo
    public function store(AddProductRequest $request)
    {
        // Validar si el producto a crear cumple con las reglas
        if ($request->validated()) {

            //  Obtener todos los datos del form
            $data = $request->all();

            // Guardar la ruta de la imagen de la miniatura del producto 
            $data['thumbnail'] = $this->saveImage($request->file('thumbnail'));

            //  verificar si el user envio la 1ª imagen
            if ($request->has('first_image')) {
                $data['first_image'] = $this->saveImage($request->file('first_image'));
            }
            //  verificar si el user envio la 2ª imagen
            if ($request->has('second_image')) {
                $data['second_image'] = $this->saveImage($request->file('second_image'));
            }
            //  verificar si el user envio la 3ª imagen
            if ($request->has('third_image')) {
                $data['third_image'] = $this->saveImage($request->file('third_image'));
            }

            // Generar un slug (version amigable para web) a partir del producto
            $data['slug'] = Str::slug($request->name);


            // El producto es ingresado en la DB a traves de la var $data e informacion almacenada en $product
            $product = Product::create($data);
            // Sincronizar los colores enviadas en la solicitud
            $product->colors()->sync($request->color_id);
            // Sincronizar los talles enviados en la solicitud
            $product->sizes()->sync($request->size_id);

            // Una vez guardado, redirigir al user a la view products.index 
            return redirect()->route('admin.products.index')->with([
                // Mensaje
                'success' => 'El Producto se ha creado correctamente!'
            ]);
        }
    }

    // Mostrar un recurso específico
    public function show(Product $product)
    {
        // Si la pagina no fue encontrada se muestra el error 404
        abort(404);
    }

    // Mostrar el formulario para editar el recurso especificado
    public function edit(Product $product)
    {
          // En este form necesito que muestre la lista de los tamaños y colores disponibles 
          $colors = Color::all();
          $sizes = Size::all();
          // Esta informacion debo enviar a la vista
          return view('admin.products.edit')->with([
              'colors' => $colors,
              'sizes' => $sizes,
              // Agrego el producto a editar
              'product' => $product,
          ]);       
    }

    // Actualizar el recurso especificado en la DB 
    // Pasar la instancia de la clase "UpdateproductRequest"   
    public function update(UpdateProductRequest $request, Product $product)
    {
        // Validar si el producto a crear cumple con las reglas
        if ($request->validated()) {

            //  Obtener todos los datos del form
            $data = $request->all();

            // Si el user cambia la miniatura
            if($request->has('thumbnail')) {
                // si el user desea cambiar la imagen debo eliminar la imagen guardada. Usar metodo "removeProd..."
                $this->removeProductImageFromStorage($request->file('thumbnail'));
                // Actualizamos la imagen nueva y la url nueva
                $data['thumbnail'] = $this->saveImage($request->file('thumbnail'));
            }
            
            //  verificar si el user envio la 1ª imagen
            if ($request->has('first_image')) {
                // si el user desea cambiar la imagen debo eliminar la imagen guardada. Usar metodo "removeProd..."
                $this->removeProductImageFromStorage($request->file('first_image'));
                $data['first_image'] = $this->saveImage($request->file('first_image'));
            }
            //  verificar si el user envio la 2ª imagen
            if ($request->has('second_image')) {
                // si el user desea cambiar la imagen debo eliminar la imagen guardada. Usar metodo "removeProd..."
                $this->removeProductImageFromStorage($request->file('second_image'));
                $data['second_image'] = $this->saveImage($request->file('second_image'));
            }
            //  verificar si el user envio la 3ª imagen
            if ($request->has('third_image')) {
                // si el user desea cambiar la imagen debo eliminar la imagen guardada. Usar metodo "removeProd..."
                $this->removeProductImageFromStorage($request->file('third_image'));
                $data['third_image'] = $this->saveImage($request->file('third_image'));
            }

            // Generar un slug (version amigable para web) a partir del producto
            $data['slug'] = Str::slug($request->name);

            // Actualizar el status
            $data['status'] = $request->status;

            // El producto es ingresado en la DB a traves de la var $data e informacion almacenada en $product
            $product->update($data);
            // Sincronizar los colores enviadas en la solicitud
            $product->colors()->sync($request->color_id);
            // Sincronizar los talles enviados en la solicitud
            $product->sizes()->sync($request->size_id);

            // Una vez guardado, redirigir al user a la view products.index 
            return redirect()->route('admin.products.index')->with([
                // Mensaje
                'success' => 'El Producto se ha actualizado correctamente!'
            ]);
        }        
    }

    // Eliminar el recurso especificado de la DB
    public function destroy(Product $product)
    {
        // Antes de eliminar el producto debo eliminar las imagenes
        $this->removeProductImageFromStorage($product->thumbnail);
        $this->removeProductImageFromStorage($product->first_image);
        $this->removeProductImageFromStorage($product->second_image);
        $this->removeProductImageFromStorage($product->third_image);

        // Ahora si eliminar el producto 
        $product->delete();

        return redirect()->route('admin.products.index')->with([
            // configurar el mensaje 
            'success' => 'El Producto se ha eliminado correctamente'
        ]);
    }

    // Crear el metodo saveImage(). Pasar parametro "$file"
    public function saveImage($file) 
    {
        $image_name = time().'_'.$file->getClientOriginalName();
        $file->storeAs('images/products', $image_name, 'public');
        return 'storage/images/products/'.$image_name;
    }

    // Crear el metodo removeProductImageFromStorage()
    public function removeProductImageFromStorage($file) 
    {
        // obtener la ruta completa del archivo que se quiere eliminar
        $path = public_path('storage/images/products'.$file);
        // Verificar si el archivo existe 
        if(File::exists($path)) {
            // Si existe se elimina el archivo
            File::delete($path);
        }
    }
}
