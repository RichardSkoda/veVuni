import express from 'express'
import nodemailer from 'nodemailer'
import cors from 'cors'
import { fileURLToPath } from 'url'
import { dirname, join } from 'path'

const __filename = fileURLToPath(import.meta.url)
const __dirname = dirname(__filename)

const app = express()
const PORT = process.env.PORT || 3000

// Middleware
app.use(cors())
app.use(express.json())

// Serve static Vue build files
app.use(express.static(join(__dirname, '..', 'dist')))

// Contact form API endpoint
app.post('/api/contact', async (req, res) => {
  const { name, email, service, message } = req.body

  // Validation
  if (!name || !email || !service || !message) {
    return res.status(400).json({ error: 'Všechna pole jsou povinná.' })
  }

  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
  if (!emailRegex.test(email)) {
    return res.status(400).json({ error: 'Neplatná e-mailová adresa.' })
  }

  try {
    // Configure your SMTP settings here
    // For production, use real SMTP credentials
    const transporter = nodemailer.createTransport({
      host: process.env.SMTP_HOST || 'smtp.gmail.com',
      port: parseInt(process.env.SMTP_PORT) || 587,
      secure: false,
      auth: {
        user: process.env.SMTP_USER || 'your-email@gmail.com',
        pass: process.env.SMTP_PASS || 'your-app-password'
      }
    })

    const mailOptions = {
      from: `"VeVůni Web" <${process.env.SMTP_USER || 'noreply@vevuni.cz'}>`,
      to: 'michal@vevuni.cz',
      replyTo: email,
      subject: `[VeVůni] Nová poptávka: ${service}`,
      html: `
        <div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;">
          <div style="background: #1a1a2e; padding: 20px; text-align: center;">
            <h1 style="color: #c9a84c; margin: 0;">VeVůni</h1>
            <p style="color: rgba(255,255,255,0.7); margin: 5px 0 0;">Nová poptávka z webu</p>
          </div>
          <div style="padding: 30px; background: #f8f9fa;">
            <table style="width: 100%; border-collapse: collapse;">
              <tr>
                <td style="padding: 10px; font-weight: bold; color: #1a1a2e; border-bottom: 1px solid #e0e0e0;">Jméno:</td>
                <td style="padding: 10px; border-bottom: 1px solid #e0e0e0;">${name}</td>
              </tr>
              <tr>
                <td style="padding: 10px; font-weight: bold; color: #1a1a2e; border-bottom: 1px solid #e0e0e0;">E-mail:</td>
                <td style="padding: 10px; border-bottom: 1px solid #e0e0e0;"><a href="mailto:${email}">${email}</a></td>
              </tr>
              <tr>
                <td style="padding: 10px; font-weight: bold; color: #1a1a2e; border-bottom: 1px solid #e0e0e0;">Služba:</td>
                <td style="padding: 10px; border-bottom: 1px solid #e0e0e0;">${service}</td>
              </tr>
              <tr>
                <td style="padding: 10px; font-weight: bold; color: #1a1a2e; vertical-align: top;">Zpráva:</td>
                <td style="padding: 10px;">${message.replace(/\n/g, '<br>')}</td>
              </tr>
            </table>
          </div>
          <div style="background: #1a1a2e; padding: 15px; text-align: center;">
            <p style="color: rgba(255,255,255,0.4); margin: 0; font-size: 12px;">Odesláno z webu VeVůni</p>
          </div>
        </div>
      `
    }

    await transporter.sendMail(mailOptions)

    res.json({ success: true, message: 'E-mail byl úspěšně odeslán.' })
  } catch (error) {
    console.error('Email error:', error)
    res.status(500).json({
      error: 'Nepodařilo se odeslat e-mail. Zkuste to prosím později.'
    })
  }
})

// SPA fallback - serve index.html for all non-API routes
app.get('*', (req, res) => {
  res.sendFile(join(__dirname, '..', 'dist', 'index.html'))
})

app.listen(PORT, () => {
  console.log(`✨ VeVůni server running at http://localhost:${PORT}`)
})
