import React, { useEffect, useState } from 'react'
import { useDebounce } from 'use-debounce'
import { axiosRequest } from './helpers/config'
import Alert from './layouts/Alert'
import Spinner from './layouts/Spinner'
import ProductsList from './products/ProductsList'

export default function Home() {

  const [products, setProducts] = useState([])
  const [colors, setColors] = useState([])
  const [sizes, setSizes] = useState([])
  const [loading, setLoading] = useState(false)

  const [selectColor, setSelectColor] = useState('')
  const [selectSize, setSelectSize] = useState('')
  const [searchTerm, setSearchTerm] = useState('')
  const [message, setMessage] = useState('')
  const [debouncedSearchTerm] = useDebounce(searchTerm, 500)

  const handleColorSelectBox = (e) => {
    setSelectSize('')
    setSearchTerm('')
    setSelectColor(e.target.value)
  }
  
  const handleSizeSelectBox = (e) => {
    setSelectColor('')
    setSearchTerm('')
    setSelectSize(e.target.value)
  }

  const clearFilters = () => {
    setSelectColor('')
    setSelectSize('')
    setSearchTerm('')
  }

  useEffect(() => {
    const fetchAllProducts = async () => {
      setMessage('')
      setLoading(true)
      
      try {
        // verificar si hay un color seleccionado
        if (selectColor) {          
          const response = await axiosRequest.get(`products/${selectColor}/color`)
          setProducts(response.data.data)        
          setColors(response.data.colors)        
          setSizes(response.data.sizes) 
          setLoading(false)       
        } else if (selectSize) {
          const response = await axiosRequest.get(`products/${selectSize}/size`)
          setProducts(response.data.data)        
          setColors(response.data.colors)        
          setSizes(response.data.sizes)
          setLoading(false)
        } else if (debouncedSearchTerm[0]) {
          const response = await axiosRequest.get(`products/${searchTerm}/find`)
          if (response.data.data.length > 0) {
            setProducts(response.data.data)        
            setColors(response.data.colors)        
            setSizes(response.data.sizes)
            setLoading(false)
          } else {
            setMessage('Lo sentimos. No se encontraron productos que coincidan con tu Busqueda.')
            setLoading(false)
          }
        }
        else {
          const response = await axiosRequest.get('products')
          setProducts(response.data.data)        
          setColors(response.data.colors)        
          setSizes(response.data.sizes) 
          setLoading(false)       
        }
      } catch (error) {
        console.log(error)
      }
    }
    fetchAllProducts()  
    // useEffect se ejecuta solo cuando uno de los valores cambie
  },[selectColor, selectSize, debouncedSearchTerm[0]])  
  
  return (
    <div className='row my-5'>
      <div className='col-md-12'>
        <div className='row'>
          <div className='col-md-8 mx-auto'>
            <div className='row'>

              <div className='col-md-4 mb-2'>
                <div className='mb-2'>
                  <span className='fw-bold'>
                    Filtrar por color:
                  </span>
                </div>
                  <select name="color_id" id="color_id" defaultValue='' 
                    onChange={ (e) => handleColorSelectBox(e) } 
                    disabled={ selectSize || searchTerm }
                    className="form-select"
                  >
                    <option value='' disabled={ !selectColor } 
                      onChange={ () => clearFilters }
                      >
                        Todos los colores
                    </option>
                    {
                      colors?.map((color) => (
                        <option key={ color.id } value={ color.id }>{ color.name }</option>
                      ))
                    }
                  </select>                  
              </div>

              <div className='col-md-4 mb-2'>
                <div className='mb-2'>
                  <span className='fw-bold'>
                    Filtrar por tamaño:
                  </span>
                </div>
                  <select name="size_id" id="size_id" defaultValue='' 
                    onChange={ (e) => handleSizeSelectBox(e) } 
                    disabled={ selectColor || searchTerm }
                    className="form-select"
                  >
                    <option value='' disabled={ !selectSize } 
                      onChange={ () => clearFilters }
                      >
                        Todos los Tamaños
                    </option>
                    {
                      sizes?.map((size) => (
                        <option key={ size.id } value={ size.id }>{ size.name }</option>
                      ))
                    }
                  </select>                
              </div>

              <div className='col-md-4 mb-2'>
                <div className='mb-2'>
                  <span className='fw-bold'>
                    Buscar Producto:
                  </span>
                </div>
                <form className='d-flex'>
                  <input type="search" className='form-control me-2'
                    value={ searchTerm }  
                    disabled={ selectColor || selectSize }
                    onChange={ (e) => setSearchTerm(e.target.value) }
                    placeholder='Buscar...'
                  />                  
                </form>
              </div>
            </div>
          </div>
        </div>
        {
          message ?
          <Alert type='primary' content={ message } />
          :
          loading ?
          <Spinner />
          :
          <ProductsList products={products} />
        }
    </div>
  </div>
)}
