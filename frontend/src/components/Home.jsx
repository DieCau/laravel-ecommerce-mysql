import React, { useEffect, useState } from 'react'
import { axiosRequest } from './helpers/config'
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
      try {
        const response = await axiosRequest.get('products')
        setProducts(response.data.data)        
        setColors(response.data.colors)        
        setSizes(response.data.sizes)        
      } catch (error) {
        console.log(error)
      }
    }
    fetchAllProducts()  
  },[])
  
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
                  <select name="color_id" id="color_id" defaultValue='' 
                    onChange={ (e) => handleColorSelectBox(e) } 
                    disabled={ selectSize || searchTerm }
                    className="form-select">
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
              </div>
            </div>
          </div>
        </div>
      <ProductsList products={products} />
    </div>
  </div>
)}
