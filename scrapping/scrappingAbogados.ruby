require 'open-uri'
require 'nokogiri'
require 'csv'

class Scraper
  def infoAbogados
    linkAbg = "https://app.funcionjudicial.gob.ec/ForoAbogados/Publico/frmConsultasGenerales.jsp"

    CSV.open("abogados.csv", 'wb') do |csv|
    csv << %w[nro matricula nombres direccion credencial estado]
    puts "Haciendo scraping"
    datos = URI.open(linkAbg)
    pagina = datos.read
    doc = Nokogiri::HTML(pagina)
    tabla = doc.css("#idTableAbogados")

    prueba = []
    espacio = []
    matriculas = []
    nombres = []
    direcciones = []
    credenciales = []
    estados = []

    tabla.css("tr").each do |fila|
      d = fila.text
      prueba << d  
      
    end
    #puts prueba

    for i in 0..prueba.length()-1
      espacio << prueba[i].split()
    end
    #puts espacio

    for i in 1..espacio.length()-1
      datosAb = espacio[i] #datos de cada abogado
      linea = []
      for j in 1..datosAb.length()-1
        if j==1
          matriculas << datosAb[j]
        elsif j == datosAb.length()-1
          estados << datosAb[j]
        elsif j == datosAb.length-2
          credenciales << datosAb[j]
        elsif j==2
          nomb = datosAb[2]+" "+datosAb[3] +" "+ datosAb[4]+" "+datosAb[5] 
          nombres << nomb
        else
          if datosAb[j].end_with? (",")
            dir = ""
            for k in 6..j-1
              dir = dir+datosAb[k]+" "
            end
            direcciones << dir
          end
        end
      end
    end
    #puts espacio
      #puts direcciones
    #puts matriculas
    for i in 0..matriculas.length()-1
      nro=i+1
      csv << [nro.to_s,matriculas[i].to_s, nombres[i].to_s, direcciones[i].to_s, credenciales[i].to_s, estados[i].to_s]
    end
    end
  end
end

a = Scraper.new
a.infoAbogados
