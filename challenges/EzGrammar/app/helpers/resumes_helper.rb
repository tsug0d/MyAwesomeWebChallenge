module ResumesHelper
	def hash_calc filepath
			pepper='V3Ry_Pr1v4t3@tsu' # Sorry, can't give you this
			salt=Secretttt.first.thinkoutoftheboxsmileicon
			# see why we are doing this: https://security.stackexchange.com/questions/3272/password-hashing-add-salt-pepper-or-is-salt-enough 
			return Digest::SHA1.hexdigest(pepper+filepath+salt).to_s
	end

	def create_valid_upload_link filepath
		return filepath[1..-1]
	end

	def avoid_error input_string
		idx= input_string=~ /\~|\`|\!|\@|\#|\$|\%|\^|\&|\*|\-|\_|\+|\=|\[|\]|\{|\}|\:|\;|\'|\"|\<|\>|\,|\.|\?|\/|\|/
		if !idx
			return true
		else
			return false
		end
	end
end
