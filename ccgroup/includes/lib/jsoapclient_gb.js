(function($) {
	jQuery.jSOAPClient_gb = Object();
	jQuery.jSOAPClient_gb.location = "http://localhost/webservice/",
	jQuery.jSOAPClient_gb.urn = "http://localhost/webservice/",
	jQuery.jSOAPClient_gb.success = function(data){},
	jQuery.jSOAPClient_gb.error = function(data){},
	jQuery.jSOAPClient_gb.setLocation = function(location){
		this.location = location;
	},
	jQuery.jSOAPClient_gb.setUrn = function(urn){
		this.urn = urn;
	},
	jQuery.jSOAPClient_gb.setSuccess = function(success){
		this.success = success;
	},
	jQuery.jSOAPClient_gb.setError = function(error){
		this.error = error;
	},
	jQuery.jSOAPClient_gb.call = function(method, data){
		d = jQuery.parseJSON(data);
		sm  = '<?xml version="1.0" encoding="UTF-8"?>';
		sm += '<SOAP-ENV:Envelope SOAP-ENV:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:SOAP-ENC="http://schemas.xmlsoap.org/soap/encoding/" ';
		sm += 'xmlns:tns="urn:'+this.urn+'">';
		sm += '<SOAP-ENV:Body>';
		sm += '<tns:'+method+' xmlns:tns="urn:'+this.urn+'">';
		jQuery.each(d.data, function(){
			sm += '<'+method+' xsi:type="'+this.type+'">'+this.value+'</'+method+'>';
		});
		sm += '</tns:'+method+'>';
		sm += '</SOAP-ENV:Body>';
		sm += '</SOAP-ENV:Envelope>';
		jQuery.ajax({
				url: this.location,
				type: 'POST',
				data: sm,
				contentType: "text/xml",
				crossDomain: true,
				dataType: "text",
				success: jQuery.jSOAPClient_gb.success,
				error: jQuery.jSOAPClient_gb.error
		});
	},
	jQuery.jSOAPClient_gb.consume = function(location, urn, method, data, success, error){
		this.setLocation(location);
		this.setUrn(urn);
		this.setSuccess(success);
		this.setError(error);
		this.call(method, data);
	};
})(jQuery);
