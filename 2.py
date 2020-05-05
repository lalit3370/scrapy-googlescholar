import scrapy

class CitSpider(scrapy.Spider):
    
    name = "page2"
    
    
    def start_requests(self):
        url = "https://scholar.google.co.in/scholar?oi=bibs&hl=en&cites=10438299327049367009"
        yield scrapy.Request(url, self.parse)
    
    def parse(self, response):
            for divs in response.css(".gs_ri"):
                yield {
                    "title": divs.css("h3.gs_rt a::text").extract_first(),
                    "authors": divs.css(".gs_a a::text").extract(),
                    "journal": divs.css(".gs_a::text").extract(),
                    }
