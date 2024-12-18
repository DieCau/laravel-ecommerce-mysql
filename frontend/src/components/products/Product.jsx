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
  const [colors, setColors] = useState([])
  const [sizes, setSizes] = useState([])
  const [loading, setLoading] = useState(false)
  const [quantity, setQuantity] = useState(1)
  const [error, setError] = useState('')

  const { slug } = useParams()

  useEffect(() => {
    const fetchProductBySlug = async () => {
      setLoading(true)
      try {
        const response = await axiosRequest.get(`products/${slug}/show`)
        setProduct(response.data.data)
        setColors(response.data.colors)
        setSizes(response.data.sizes)
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
            {/* Sizes */}
            <div className='d-flex justify-content-between'>
              <div className='d-flex justify-content-start align-items-center mb-3'>
                {
                  product.sizes?.map((size) => (
                    <span key={size.id} className='bg-dark-subtle text-dark me-2 pe-1 ps-1 fw-bold'>
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
                  <div key={color.id} className='me-1 border border-dark-subtle border-1'
                    style={{
                      backgroundColor: colorTranslations[color.name.toLowerCase()] || 'transparent',
                      width: '20px',
                      height: '20px',
                      borderRadius: '50%'
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
          </div>
        </div>
      }
    </div>
  )
}
