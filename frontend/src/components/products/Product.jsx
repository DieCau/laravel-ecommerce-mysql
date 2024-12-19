import { Parser } from 'html-to-react'
import React, { useEffect, useState } from 'react'
import { useParams } from 'react-router-dom'
import { colorTranslations } from '../helpers/colorTranslations'
import { axiosRequest } from '../helpers/config'
import Alert from '../layouts/Alert'
import Spinner from '../layouts/Spinner'
import Sliders from './images/Sliders'

export default function Product() {
  const [product, setProduct] = useState([])
  const [loading, setLoading] = useState(false)
  const [selectColor, setSelectColor] = useState('')
  const [selectSize, setSelectSize] = useState('')
  const [error, setError] = useState('')
  const [quantity, setQuantity] = useState(1)

  const { slug } = useParams()

  useEffect(() => {
    const fetchProductBySlug = async () => {
      setLoading(true)
      try {
        const response = await axiosRequest.get(`products/${slug}/show`)
        setProduct(response.data.data)
        selectColor(response.data.colors)
        setSelectSize(response.data.sizes)
        setLoading(false)
      } catch (error) {
        if (error?.response?.status === 404) {
          setError('Lo sentimos, pero el producto que buscas no esta disponible.')
        }
        console.log(error)
        setLoading(false)
      }
    }
    fetchProductBySlug()
  }, [slug])

  const decrementQuantity = () => {
    if (quantity > 1) {
      setQuantity(quantity - 1)
    }
  }
  const incrementQuantity = () => {
    if (quantity < product?.quantity) {
      setQuantity(quantity + 1)
    }
  }

  const handleInputChange = (e) => {
    const value = Math.max(1, Math.min(Number(e.target.value), product?.quantity || 1))
    setQuantity(value)
  }

  return (
    <div className='card my-5'>
      {
        error ?
        <Alert type='danger' content={error} />
        :
        loading ?
        <Spinner />
        :
        <div className='row g-0'>
          <div className='col-md-4 p-2'>
            <Sliders product={product} />            
          </div>
          <div className='col-md-8'>
            <div className='card-body'>
              <div className='d-flex justify-content-between'>
                <h5 className='text-dark'>{product?.name}</h5>
                <h6 className='badge bg-success p-2'>${product?.price}</h6>
              </div>
            </div>
            {/* Tamaños */}
            <div className='d-flex justify-content-between'>
              <div className='d-flex justify-content-start align-items-center mb-3'>
                {
                  product.sizes?.map((size) => (
                    <span key={size.id} 
                          onClick={() => setSelectSize(size)}
                          style={{cursor: 'pointer'}}
                          className={`border border-2 bg-dark-subtle text-dark me-2 pe-1 ps-1 fw-medium
                            ${selectSize?.id === size.id 
                              ? 'border border-2 border-dark-subtle fw-bold text-decoration-underline' 
                              : '' }
                          `}>
                      <small>{size.name}</small>
                    </span>
                  ))
                }
              </div>
              {/* Stock - Status */}
              <div className='me-3'>
                {
                  product.status == 1 ?
                    <span className='badge bg-warning p-2'>En stock</span>
                    :
                    <span className='badge bg-danger p-2'>Sin stock</span>
                }
              </div>
            </div>
            {/* Colors */}
            <div className='d-flex justify-content-start align-items-center mt-2'>
              {
                product.colors?.map((color) => (
                  <div key={color.id}
                    onClick={() => setSelectColor(color)} 
                    className={`me-1 border border-dark-subtle border-1
                      ${selectColor?.id === color.id 
                        ? 'border border-dark-subtle border-2 bi bi-x-lg text-light d-flex justify-content-center align-items-center' 
                        : ''}
                      `}
                    style={{
                      backgroundColor: colorTranslations[color.name.toLowerCase()] || 'transparent',
                      width: '20px',
                      height: '20px',
                      borderRadius: '50%',
                      cursor: 'pointer'
                    }}>
                  </div>
                ))
              }
            </div>
            <div className='my-3'>
              {
                Parser().parse(product?.desc)                
              }
            </div>
            <div className='row mt-5'>
              <div className='d-flex justify-content-center'>
                <div className='input-group mb-5' style={{ width: '150px' }}>
                  <button className='btn btn-outline-secondary' 
                    type='button'
                    onClick={decrementQuantity}
                    disabled={quantity <= 1}
                  > - </button>
                  <input type='number' className='form-control' 
                    placeholder='Cantidad'
                    value={quantity}
                    onChange={handleInputChange}
                    min={1}
                    max={product?.quantity > 1 ? product?.quantity : 1}
                  />
                  <button className='btn btn-outline-secondary' 
                    type='button'
                    onClick={incrementQuantity}
                    disabled={quantity >= product?.quantity}
                  > + </button>
                </div>
              </div>
            </div>
            <div className='d-flex justify-content-center'>
              <button className='btn btn-dark' 
              disabled={ !selectColor || !selectSize || product?.quantity == 0 } 
              >
                <i className='bi bi-cart-fill'></i>{" "} Agregar al Carrito
              </button>
            </div>
          </div>
        </div>
      }
    </div>
  )
}
